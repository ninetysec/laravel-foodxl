<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Contact extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'contact';

    public    $timestamps = false;

    // protected $appends = ['cat_name'];
    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];
    //
    
    public static function post(array $attributes)
    {
        extract($attributes);

        $email = '10767044@qq.com';$name = 'aa';$message = 'bbbb';

	    $name = '数据';
	    $flag = Mail::send('contact',['name'=>$name],function($res){
	        $to = '10767044@qq.com';
	        $res ->to($to)->subject('测试邮件');
	    });
	    if($flag){
	        echo '发送邮件成功，请查收！';
	    }else{
	        echo '发送邮件失败，请重试！';
	    }

        /*$user = ['name' => $name, 'email' => $email];

        // Mail::to(['address' => $email,'name' => $name])->send($message);
		$flag = Mail::send('contact', ['name' => $email], function ($m) use ($user) {
            $m->to($user['email'], $user['name'])->subject('Your Reminder!');
        });*/
		
		var_dump($flag);

        return true;
    }
}
