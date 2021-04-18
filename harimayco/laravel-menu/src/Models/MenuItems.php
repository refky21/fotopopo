<?php

namespace Harimayco\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{

    protected $table = null;

    protected $fillable = [
		'parent', 'group', 'title', 'url', 'class', 'target', 'position', 'created_by','depth', 'updated_by'
	];
    // protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth', 'role_id'];

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = 'menus';
    }

    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }
    public function getall($id)
    {
        return $this->where("group", $id)->orderBy("position", "asc")->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('group', $menu)->max('position') + 1;
    }

    public function parent_menu()
    {
        return $this->belongsTo('Harimayco\Menu\Models\Menus', 'group');
    }

    public function child()
    {
        return $this->hasMany('Harimayco\Menu\Models\MenuItems', 'parent')->orderBy('position', 'ASC');
    }
}
