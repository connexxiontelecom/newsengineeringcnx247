<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Driver;
use App\Http\Controllers\Controller;
use App\PostAttachment;
use App\WorkgroupAttachment;
use Illuminate\Http\Request;
use App\Folder;
use App\FileModel;
use App\SharedFile;
use App\User;
use App\SharedFolder;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
//use Storage;
//use File;
use Response;


class CNX247DriveController extends Controller
{
    public $root = 'assets/uploads/cnxdrive/';
    public function __construct()
    {
        $this->middleware('auth');
    }

    #Tutorial
    public function show(){
        # return Storage::files('public'); // return all files in a directory
        #Show file url by file name
        #return Storage::url($this->root.'/'.'cus_15967230642020.jpeg');
        $url =  Storage::url($this->root.'/'.'cus_15967230642020.jpeg');
        # return "<img src='".$url."' />";
        #Get file size
        $size = Storage::size($this->root.'/'.'cus_15967230642020.jpeg');
        return $size;
    }

    /*
    * Load activity stream index page
    */
    public function index(){

			$plan_details = DB::table('plan_features')
				->where('plan_id', '=', Auth::user()->tenant->plan_id)
				->first();

			$storage_size = $plan_details->storage_size;



        //$directory = Storage::allDirectories(public_path());
        $files = Storage::allFiles($this->root);
        $directories = Storage::allDirectories($this->root);


        $myFiles = FileModel::where('tenant_id', Auth::user()->tenant_id)
                            ->where('uploaded_by', Auth::user()->id)
														->where('folder_id', null)->get();

        $sharedFiles = SharedFile::where('shared_files.tenant_id', Auth::user()->tenant_id)
															->join('users', 'shared_files.owner', '=', 'users.id')
                            ->where('shared_with', Auth::user()->id)->get();

        $shardFolders = SharedFolder::where('shared_folders.tenant_id', Auth::user()->tenant_id)
					->join('folders', 'shared_folders.folder_id', '=', 'folders.id')
					->join('users', 'shared_folders.owner', '=', 'users.id')
					                           ->where('shared_with', Auth::user()->id)->get();

        $myFolders = Folder::where('tenant_id', Auth::user()->tenant_id)
                            ->where('created_by', Auth::user()->id)
														->where('parent_id', 0)->get();

        $publicFolders = Folder::where('tenant_id', Auth::user()->tenant_id)
                            ->where('permission', 1);

        $size = FileModel::where('tenant_id', Auth::user()->tenant_id)
                            ->where('uploaded_by', Auth::user()->id)->sum('size');

					$postAttachments = PostAttachment::where('tenant_id', Auth::user()->tenant_id)->get();
				//print_r($postAttachments);
					$sum_post_attachment = 0;
					foreach ($postAttachments as $postAttachment){

						if(file_exists(public_path('assets\uploads\attachments\\'.$postAttachment->attachment))){
						$fileSize = \File::size(public_path('assets\uploads\attachments\\'.$postAttachment->attachment));
						//echo $fileSize;
						$sum_post_attachment = $sum_post_attachment + $fileSize;
						}

						if(file_exists(public_path('assets\uploads\requisition\\'.$postAttachment->attachment))){
							$fileSize = \File::size(public_path('assets\uploads\requisition\\'.$postAttachment->attachment));
							//echo $fileSize;
							$sum_post_attachment = $sum_post_attachment + $fileSize;
						}

					}

						$workgroupAttachments = WorkgroupAttachment::where('tenant_id', Auth::user()->tenant_id)->get();

						$sum_workgroup_attachment = 0;
						foreach ($workgroupAttachments as $workgroupAttachment):
							if(file_exists(public_path('assets\uploads\attachments\\'.$workgroupAttachment->attachment))):
							$fileSize = \File::size(public_path('assets\uploads\attachments\\'.$workgroupAttachment->attachment));

							$sum_workgroup_attachment = $sum_workgroup_attachment + $fileSize;
							endif;

						endforeach;

						$drivers = Driver::where('tenant_id', Auth::user()->tenant_id)->get();

						$sum_driver_attachment = 0;

						foreach($drivers as $driver):
							if(file_exists(public_path('assets\uploads\logistics\\'.$driver->attachment))):
							$fileSize = \File::size(public_path('assets\uploads\logistics\\'.$driver->attachment));
							//echo $fileSize;
							$sum_driver_attachment = $sum_driver_attachment + $fileSize;
						endif;
							endforeach;


						$size = $sum_post_attachment + $sum_driver_attachment + $sum_workgroup_attachment + $size;





			$employees = User::where('tenant_id', Auth::user()->tenant_id)->get();

			//echo $storage_size;
        //return dd($files);
        return view('backend.cnx247drive.index',
        ['directories'=>$directories,
        'files'=>$files,
        'myFiles'=>$myFiles,
        'size'=>$size,
        'employees'=>$employees,
        'sharedFiles'=>$sharedFiles,
            'sharedFolders' => $shardFolders,
            'myFolders' => $myFolders,
            'publicFolders' => $publicFolders,
						'storage_size' => $storage_size
        ]);
    }

	public function search(Request $request){

    	if(empty($request)):

				return redirect(route('cnx247-drive'));

    	else:
		//$directory = Storage::allDirectories(public_path());
		$files = Storage::allFiles($this->root);
		$directories = Storage::allDirectories($this->root);

		$folders =
		$myFiles = FileModel::where('name', 'like', "%{$request->name}%")
			//->where('name', 'like', "%{$request->name}%")
//			->orWhere('name', 'like', $request->name.'%')
//			->orWhere('name', 'like', '%'.$request->name)
			->where('uploaded_by', Auth::user()->id)
			->where('tenant_id', Auth::user()->tenant_id)
			->where('folder_id', null)->get();


		$myFolders = Folder::where('tenant_id', Auth::user()->tenant_id)
			->where('created_by', Auth::user()->id)
			->where('name', 'like', "%{$request->name}%")
//			->orWhere('name', 'like', '%'.$request->name.'%')
//			->orWhere('name', 'like', $request->name.'%')
//			->orWhere('name', 'like', '%'.$request->name)
				->get();



		$allFiles = FileModel::where('tenant_id', Auth::user()->tenant_id)
//			->orWhere('name', 'like', '%'.$request->name.'%')
//			->orWhere('name', 'like', $request->name.'%')
//			->orWhere('name', 'like', '%'.$request->name)
				->where('name', 'like', "%{$request->name}%")->get();

		$i = 0;

		$sharedFiles = [];
		foreach ($allFiles as $file):
			$files = SharedFile::where('shared_files.tenant_id', Auth::user()->tenant_id)
				->join('users', 'shared_files.owner', '=', 'users.id')
				->where('file_id', $file->id)->first();

			if(!empty($files)):
				$sharedFiles[$i] = $files;
				$i++;

			endif;
			endforeach;




		$allFolders = Folder::where('tenant_id', Auth::user()->tenant_id)
													->where('name', 'like', "%{$request->name}%")
//													->orWhere('name', 'like', '%'.$request->name.'%')
//													->orWhere('name', 'like', $request->name.'%')
//												->orWhere('name', 'like', '%'.$request->name)
													->get();

		$i = 0;
		$sharedFolders = [];
		foreach($allFolders as $folder):

			$folders = SharedFolder::where('shared_folders.tenant_id', Auth::user()->tenant_id)
				->where('shared_folders.folder_id', $folder->id)
				->join('folders', 'shared_folders.folder_id', '=', 'folders.id')
				->join('users', 'shared_folders.owner', '=', 'users.id')
				->where('shared_with', Auth::user()->id)->first();



		if(!empty($folders)):

			$sharedFolders[$i] = $folders;
				$i++;
			endif;


			endforeach;


		$publicFolders = Folder::where('tenant_id', Auth::user()->tenant_id)
			->where('permission', 1)
			->where('name', 'like', "%{$request->name}%")
//			->orWhere('name', 'like', '%'.$request->name.'%')
//			->orWhere('name', 'like', $request->name.'%')
//			->orWhere('name', 'like', '%'.$request->name)
			->get();

		$size = FileModel::where('tenant_id', Auth::user()->tenant_id)
			->where('uploaded_by', Auth::user()->id)->sum('size');

		$employees = User::where('tenant_id', Auth::user()->tenant_id)->get();

		//print_r($sharedFolders);

		//print_r($sharedFiles);
		//return dd($files);
		return view('backend.cnx247drive.search',
			['directories'=>$directories,
				'files'=>$files,
				'myFiles'=>$myFiles,
				'size'=>$size,
				'employees'=>$employees,
				'sharedFiles'=>$sharedFiles,
				'sharedFolders'=>$sharedFolders,
				'myFolders' => $myFolders,
				'publicFolders' => $publicFolders,
				'name' => $request->name
			]);

		endif;

		//print_r($sharedFolders);
	}

    /*
    * Make directory
    */
    public function createDirectory(Request $request){
        $this->validate($request,[
            'folder_name'=>'required'
        ]);
        $folder = new Folder;
        $folder->folder = $request->folder_name;
        $folder->created_by = Auth::user()->id;
        $folder->tenant_id = Auth::user()->tenant_id;
        $folder->password = !empty($request->password)  ? bcrypt($request->password) : '';
        $folder->location = $this->root;
        $folder->save();
        Storage::makeDirectory($this->root.'/'.$request->folder_name); //create directory
        #Storage::deleteDirectory($this->root.'/'.$request->folder_name); //delete directory
        session()->flash("success", "<strong>Success!</strong> Folder created");
        return redirect()->back();
    }

    /*
    * Upload file to directory
    */
    public function uploadFile(Request $request){
        if($request->hasFile('attachment')){
            //$request->file('attachment');

        if(!empty($request->attachment)){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $filename = Auth::user()->tenant->company_name.'_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $dir = 'assets/uploads/cnxdrive/';
            $request->file('attachment')->move(public_path($this->root), $filename);
            //$request->share_file->storeAs('workgroup', $filename);
/*             $post_attachment = new WorkgroupAttachment;
            $post_attachment->attachment = $filename;
            $post_attachment->tenant_id = Auth::user()->tenant_id;
            $post_attachment->workgroup_id = $request->fileGroupId;
            $post_attachment->post_id = $postId;
            $post_attachment->user_id = Auth::user()->id;
            $post_attachment->save(); */
        }

           // $request->attachment->storeAs('workgroup', Auth::user()->tenant->company_name.'_'.time().date('Y').'.'.$request->attachment->extension());
            #Path
                //$request->attachment->path();
            #extension
                //$request->attachment->extension();
            #Store file
               //1.  $request->attachment->store('public');
               //2.  Storage::putFile('public', $request->file('attachment')); //use storage function
        }else{
            return 'No file selected.';
        }
    }

    public function uploadAttachment(Request $request){
         $this->validate($request,[
            'attachment'=>'required'
        ]);
        //$consumption = FileModel::where('tenant_id', Auth::user()->tenant_id)
                                //->where('uploaded_by', Auth::user()->id)->sum('size');

			$plan_details = DB::table('plan_features')
				->where('plan_id', '=', Auth::user()->tenant->plan_id)
				->first();

			$storage_size = $plan_details->storage_size;

			$size = FileModel::where('tenant_id', Auth::user()->tenant_id)
				->where('uploaded_by', Auth::user()->id)->sum('size');


			$postAttachments = PostAttachment::where('tenant_id', Auth::user()->tenant_id)->get();
			//print_r($postAttachments);
			$sum_post_attachment = 0;
			foreach ($postAttachments as $postAttachment){
				if(file_exists(public_path('assets\uploads\attachments\\'.$postAttachment->attachment))){
					$fileSize = \File::size(public_path('assets\uploads\attachments\\'.$postAttachment->attachment));
					//echo $fileSize;
					$sum_post_attachment = $sum_post_attachment + $fileSize;
				}

				if(file_exists(public_path('assets\requisition\requisition\\'.$postAttachment->attachment))){
					$fileSize = \File::size(public_path('assets\uploads\requisition\\'.$postAttachment->attachment));
					//echo $fileSize;
					$sum_post_attachment = $sum_post_attachment + $fileSize;
				}

			}


			$workgroupAttachments = WorkgroupAttachment::where('tenant_id', Auth::user()->tenant_id)->get();

			$sum_workgroup_attachment = 0;
			foreach ($workgroupAttachments as $workgroupAttachment){
				if(file_exists(public_path('assets\uploads\attachments\\'.$workgroupAttachment->attachment))){
					$fileSize = \File::size(public_path('assets\uploads\attachments\\'.$workgroupAttachment->attachment));

					$sum_workgroup_attachment = $sum_workgroup_attachment + $fileSize;
			}

		}

			$drivers = Driver::where('tenant_id', Auth::user()->tenant_id)->get();

			$sum_driver_attachment = 0;

			foreach($drivers as $driver){
				if(file_exists(public_path('assets\uploads\logistics\\'.$driver->attachment))){
					$fileSize = \File::size(public_path('assets\uploads\logistics\\'.$driver->attachment));
					//echo $fileSize;
					$sum_driver_attachment = $sum_driver_attachment + $fileSize;
			}
		}


			$size = ceil(($sum_post_attachment + $sum_driver_attachment + $sum_workgroup_attachment + $size)/1073741824);


        if($size >= $storage_size){
            return response()->json(["error"=>"Ooops! You've reached your maximum storage space. Upgrade. ".$size], 400);
        }else{

					$check = FileModel::Where('name', $request->filename)
						->where('folder_id', $request->folder_id)
						->get();

					if(count($check) == 0):
            if(!empty($request->file('attachment'))){
                $extension = $request->file('attachment');
                $extension = $request->file('attachment')->getClientOriginalExtension();
                $size = $request->file('attachment')->getSize();
                $dir = 'assets/uploads/cnxdrive/';
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
                $request->file('attachment')->move(public_path($dir), $filename);
            }else{
                $filename = '';
            }

					$folder_id = $request->folder_id;

            $file = new FileModel;
            $file->tenant_id = Auth::user()->tenant_id;
            $file->uploaded_by = Auth::user()->id;
            $file->filename = $filename;
            $file->name = $request->filename;
            $file->folder_id = $folder_id;
            $file->size = $size;
            $file->save();
            return response()->json(['message', 'Success! File uploaded.'], 200);
           else:
						 return response()->json(['error', 'File name already exists.'], 200);
						endif;
        }
    }

    public function downloadAttachment(Request $request){
        $this->validate($request,[
            'attachment'=>'required'
        ]);

        $file = public_path("assets/uploads/cnxdrive/".$request->attachment);
        $headers = array(
            "Content-Type: application/".$request->extension
        );
        return Response::download($file, 'Hello.pdf', $headers);
    }

    public function shareAttachment(Request $request){
        $this->validate($request,[
            //'employees'=>'required',
            'id'=>'required'
        ]);
        if($request->all == 32){
            $users = User::where('tenant_id', Auth::user()->tenant_id)->where('id', '!=', Auth::user()->id)->get();
            foreach($users as $user){
                $share = new SharedFile;
                $share->owner = Auth::user()->id;
                $share->file_id = $request->id;
                $share->tenant_id = Auth::user()->tenant_id;
                $share->shared_with = $user->id;
                $share->save();
            }
        }else{
            foreach($request->employees as $employee){
                $share = new SharedFile;
                $share->owner = Auth::user()->id;
                $share->file_id = $request->id;
                $share->tenant_id = Auth::user()->tenant_id;
                $share->shared_with = $employee;
                $share->save();
            }
        }
        if($share){
            return response()->json(['message'=>'Success! File shared.'],200);
        }else{
            return response()->json(['error'=>'Ooops File shareing failed.'],400);
        }

    }

    public function newFolder(Request $request){
        $this->validate($request,[
            //'employees'=>'required',
            'name_of_folder'=>'required',
            'parent_folder' => 'required',
            'visibility' => 'required'
        ]);

        $check = Folder::where('name', $request->name_of_folder)
												->where('parent_id', $request->parent_folder)
												->get();

        if(count($check) == 0):

        $folder = new Folder;
        $folder->parent_id = $request->parent_folder;
        $folder->tenant_id = Auth::user()->tenant_id;
        $folder->created_by = Auth::user()->id;
        $folder->name = $request->name_of_folder;
        $folder->permission = $request->visibility;
        $folder->save();

        if($folder){
            return response()->json(['message'=>'Success! Folder Created.'],200);
        }else{
            return response()->json(['error'=>'Ooops an Error Occurred.'],400);
        }
        else:

					return response()->json(['error'=>'Ooops Folder Already Exists.'],400);
				endif;

    }

	public function shareFolder(Request $request){

		if($request->all == 32){
			$users = User::where('tenant_id', Auth::user()->tenant_id)->where('id', '!=', Auth::user()->id)->get();
			//return response()->json(['message'=>$request->id]);
			foreach($users as $user){
				$share = new SharedFolder();
				$share->owner = Auth::user()->id;
				$share->folder_id = $request->id;
				$share->tenant_id = Auth::user()->tenant_id;
				$share->shared_with = $user->id;
				$share->save();
			}
		}else{
			//return response()->json(['message'=>$request->id]);
			foreach($request->employees as $employee){
				$share = new SharedFolder();
				$share->owner = Auth::user()->id;
				$share->folder_id = $request->id;
				$share->tenant_id = Auth::user()->tenant_id;
				$share->shared_with = $employee;
				$share->save();
			}
		}
		if($share){
			return response()->json(['message'=>'Success! Folder Shared.'],200);
		}else{
			return response()->json(['error'=>'Ooops Folder Shared failed.'],400);
		}

	}
    public function deleteAttachment(Request $request){
        $this->validate($request,[
            'directory'=>'required',
            'id'=>'required'
        ]);
        $file = FileModel::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->id)->first();
        if(!empty($file) ){
            $file->delete();
            unlink(public_path("assets/uploads/cnxdrive/".$request->directory));
            $shared = SharedFile::where('tenant_id', Auth::user()->tenant_id)
                                ->where('file_id', $request->id)
                                ->get();
            if(!empty($shared) ){
                foreach($shared as $sh){
                    $sh->delete();
                }
            }
            return response()->json(['message'=>'Success! File deleted.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! File does not exist'], 400);
        }
        foreach($request->employees as $employee){
            $share = new SharedFile;
            $share->owner = Auth::user()->id;
            $share->file_id = $request->id;
            $share->tenant_id = Auth::user()->tenant_id;
            $share->shared_with = $employee;
            $share->save();
        }
        if($share){
            return response()->json(['message'=>'Success! File shared.'],200);
        }else{
            return response()->json(['error'=>'Ooops File shareing failed.'],400);
        }

    }


	public function deleteFolder(Request $request){
		$this->validate($request,[
			'directory'=>'required',
			'id'=>'required'
		]);

		$folder = Folder::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->id)->first();

		$folder->delete();

		$parent_folders = Folder::where('tenant_id', Auth::user()->tenant_id)->where('parent_id', $request->id)->get();
		if(!empty($parent_folders)):
		foreach($parent_folders as $parent_folder):

			$parent_folder->delete();
			endforeach;
			endif;

		$shared_folders = SharedFolder::where('tenant_id', Auth::user()->tenant_id)->where('folder_id', $request->id)->get();
		if(!empty($shared_folders)):
		foreach($shared_folders as $shared_folder):

			$shared_folder->delete();
		endforeach;
		endif;

		$files = FileModel::where('tenant_id', Auth::user()->tenant_id)->where('folder_id', $request->id)->get();
	if(!empty($files)):
		foreach ($files as $file):

		if(!empty($file) ) {

			unlink(public_path("assets/uploads/cnxdrive/" . $file->filename));
			$file->delete();
			$shared = SharedFile::where('tenant_id', Auth::user()->tenant_id)
				->where('file_id', $request->id)
				->get();
			if (!empty($shared)) {
				foreach ($shared as $sh) {
					$sh->delete();
				}
			}
		}
		endforeach;
		endif;

	return response()->json(['message'=>'Success! Folder deleted.'], 200);
		//return response()->json(['error'=>'Ooops File shareing failed.'],400);


	}

    public function folder($folder_id){

			$myFiles = FileModel::where('tenant_id', Auth::user()->tenant_id)
										->where('uploaded_by', '=', Auth::user()->id)
										->where('folder_id', '=', $folder_id)->get();

			$myFolders = Folder::where('tenant_id', Auth::user()->tenant_id)
				->where('created_by', '=', Auth::user()->id)
				->where('parent_id', '=', $folder_id)->get();

			$folder = Folder::where('id', $folder_id)->get();
			$employees = User::where('tenant_id', Auth::user()->tenant_id)->get();
			$myFolderss = Folder::where('tenant_id', Auth::user()->tenant_id)
				->where('created_by', Auth::user()->id)->get();

			return view('backend.cnx247drive.folder',
				[
					'myFiles'=>$myFiles,
					'myFolders' => $myFolders,
					'folder_e' => $folder,
					'employees' => $employees,
					'myFolderss' => $myFolderss

				]);

		}


	public function sharedFolder($folder_id){

		$myFiles = FileModel::where('tenant_id', Auth::user()->tenant_id)
					->where('folder_id', '=', $folder_id)->get();

		$myFolders = Folder::where('tenant_id', Auth::user()->tenant_id)
					->where('parent_id', '=', $folder_id)->get();

		$folder = Folder::where('id', $folder_id)->get();
		$employees = User::where('tenant_id', Auth::user()->tenant_id)->get();
		$myFolderss = Folder::where('tenant_id', Auth::user()->tenant_id)
			->where('created_by', Auth::user()->id)->get();

		return view('backend.cnx247drive.sharedfolder',
			[
				'myFiles'=>$myFiles,
				'myFolders' => $myFolders,
				'folder_e' => $folder,
				'employees' => $employees,
				'myFolderss' => $myFolderss

			]);

	}
}
