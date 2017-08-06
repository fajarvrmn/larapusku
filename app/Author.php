<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $fillable = ['name'];

    public function book()
    {
    parent::boot();
    	self::deleting(function($author) 
    	{
    		if ($author->books->count()>0) 
    		{
    			$html = 'Penulis Tidak Bisa Dihapus Karena Masih Mempunyai Buku : ';
    			$html .= '<ul>';
    			foreach ($author->books as $book) 
    			{
    				$html .= "<li>$book->title</li>";
    			}
    			$html .= '</ul>';

    			Session::flash("flash_notification", [
    				"level"=>"danger",
    				"message"=>$html]);
    			return false;
    		}
    	});
    }

    }
    

