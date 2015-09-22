<?php

namespace App\Http;

class Flash {

    public function create($title, $message, $type='success', $color='#739E73', $icon='fa fa-check', $timeout='1700')
    {
        session()->flash('flash_message', array('title'=>$title,
                                                'message'=>$message,
                                                'type'=>$type,
                                                'color'=>$color,
                                                'icon'=>$icon,
                                                'timeout'=>$timeout
            )
        );
    }
    public function message($title, $message)
    {
        return $this->create($title, $message, 'info','#C79121', 'fa fa-shield fadeInLeft animated');
    }

    public function success($title, $message)
    {
        return $this->create($title, $message);
    }

    public function error($title, $message)
    {
        return $this->create($title, $message, 'warning','#C46A69', 'fa fa-warning shake animated', 'none');
    }


}