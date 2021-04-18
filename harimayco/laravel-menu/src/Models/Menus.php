<?php

namespace Harimayco\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    // protected $table = 'menus';

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = 'admin_menus';
    }

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    public function items()
    {
        return $this->hasMany('Harimayco\Menu\Models\MenuItems', 'group')->with('child')->where('parent', 0)->orderBy('position', 'ASC');
    }
}
