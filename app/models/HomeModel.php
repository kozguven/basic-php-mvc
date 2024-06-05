<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class HomeModel extends Eloquent
{
    protected $table = 'messages';

    public function getData()
    {
        return $this->first();
    }
}