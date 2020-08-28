<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\CommentModel;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{

    /**
     * 添加评论
     */
    public function comment(Request $request)
    {
        $goods_id = $request->input('goods_id');
        $comment_name = $request->input('comment_name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $comment_desc = $request->input('comment_desc');
        $add_time = time();
        //var_dump($goods_id);
        //var_dump($comment_name);
        //var_dump($email);

        $data = [
            'goods_id' => $goods_id,
            'comment_name'  => $comment_name,
            'email' => $email,
            'subject'   => $subject,
            'comment_desc'   => $comment_desc,
            'add_time'  => $add_time
        ];
        $res = CommentModel::insert($data);
        if($res>0){
            echo "添加评论成功，OK";
            header("refresh:2;url=/product_details/".$goods_id);
        }else{
            echo "添加评论失败，failure";
            header("refresh:2;url=/index/product_details/".$goods_id);
        }

        //添加评论排行榜
        $redis_comment_fav_list_key = 'ss:comment_goods_rank';
        Redis::zIncrBy($redis_comment_fav_list_key,1,$goods_id);
    }   

}
?>
