<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;


class Menu extends Model
{
	use LogsActivity;
	
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    // public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'parent', 'group', 'title', 'url', 'class', 'target', 'position', 'created_by', 'updated_by'
	];
	
	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by');
	}
	
	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}
	
	public function mainParent() {
		return $this->hasOne('App\Menu', 'id', 'parent')->orderBy('position');
	}
	
	public function children() {
		return $this->hasMany('App\Menu', 'parent', 'id')->orderBy('position');
	}
	
	public static function tree() {
		return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent', '=', '0')->orderBy('position')->get();
	}

  public static function wpmenu(){
    /* get menu by id*/
    // $menu = Menus::find(1);
    /* or by name */
    // $menu = Menus::where('name','Test Menu')->first();

    /* or get menu by name and the items with EAGER LOADING (RECOMENDED for better performance and less query call)*/
    // $menu = Menus::where('name','Test Menu')->with('items')->first();
    /*or by id */
    $menu = Menus::where('id', 3)->with('items')->first();

    //you can access by model result
    $public_menu = $menu->items;

    //or you can convert it to array
    $public_menu = $menu->items->toArray();

    return  $public_menu;
  }
	
	protected static $logAttributes = ['*'];
}
