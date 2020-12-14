<?php

namespace App\Http\Livewire\Backend\Themes;

use Livewire\Component;
use App\Theme as ThemeModel;
use Auth;

class Theme extends Component
{
    //public $themes;
    public function render()
    {
        return view('livewire.backend.themes.theme', ['themes'=>ThemeModel::orderBy('theme_name', 'ASC')->get()]);
    }
}
