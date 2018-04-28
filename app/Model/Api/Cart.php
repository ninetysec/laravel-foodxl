<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $connection = 'mysql';

    protected $table      = 'cart';

    public    $timestamps = false;

    // protected $appends = ['cat_name'];
    // protected $visible = ['id', 'change', 'reason', 'created_at', 'money', 'user_id', 'user_name', 'level', 'customer', 'customer_id', 'customer_level'];\
    // 

    public static function getList()
    {
        if (!is_null($model = self::where('skey', session('key'))->get()))
        {
            $model = $model->toArray();
        }
        return $model;
    }

    public static function add(array $attributes)
    {
    	extract($attributes);

        // 获取商品信息
        if (is_null($goods = Goods::where('goods_id', $goods_id)->first())) { return false; }

        // 获取购物车信息，重复相加
        if (!is_null($cart = self::where(['goods_id' => $goods_id, 'skey' => session('key')])->first()))
        {
            $cart->number += $number;
            if ($cart->save()) { return true; }
        }

        if (!empty($attr_id))
        {
            $price = GoodsAttr::where(['attr_id' => $attr_id, 'goods_id' => $goods_id])->value('attr_price');
        } else {
            $price = Goods::where('goods_id', $goods_id)->value('shop_price');
        }

        $data = array(
            'goods_id'   => $goods_id,
            'goods_name' => Goods::where(['goods_id' => $goods_id])->value('goods_name'),
            'number'     => $number,
            'attr_id'    => isset($attr_id) ? $attr_id : 0,
            'attr_value' => isset($attr_id) ? GoodsAttr::where(['goods_attr_id' => $attr_id, 'goods_id' => $goods_id])->value('attr_value') : '',
            'price'      => isset($attr_id) ? GoodsAttr::where(['goods_attr_id' => $attr_id, 'goods_id' => $goods_id])->value('attr_price') : $goods->shop_price,
            'skey'       => session('key')
        );

        $model = self::insert($data);

    	return $model;
    }

    public static function edit(array $attributes)
    {
        extract($attributes);

        // 获取地址信息
        if (isset($values))
        {
            $values = json_decode($values,true);
            if (isset($values['phone'])) {
                // $contact = Contact::where('phone',$values['phone'])->firstOrNew(['phone' => $values['phone']]);
                if (is_null($contact = Contact::where('phone', $values['phone'])->first())) {
                    Contact::insert(['phone' => $values['phone'], 'add_time' => time()]);
                    $contact = Contact::where('phone', $values['phone'])->first();
                }
                $contact->phone = $values['phone'];
            }

            if (isset($values['address'])) {
                $contact->address = strip_tags($values['address']);
            }

            if (isset($values['name'])) {
                $contact->name = strip_tags($values['name']);

            }

            if (isset($contact)) {
                $contact->save();
            }
        }

        $id = isset($id) ? explode(',',trim($id,',')) : [];
        $number = isset($number) ? explode(',',trim($number,',')) : [];

        if (is_array($id) && is_array($number)) {

            for ($i=0; $i < count($id); $i++) { 

                // 获取购物车信息
                if (is_null($cart = self::where('id', $id[$i])->where('skey', session('key'))->first())) { return false; }

                // 获取产品信息
                if (is_null($goods = Goods::where('goods_id', $cart->goods_id)->first())) { return false; }

                $new = array(
                    'number'     => $number[$i],
                    'attr_id'    => isset($attr_id) ? $attr_id : 0,
                    'attr_value' => isset($attr_id) ? GoodsAttr::where(['attr_id' => $attr_id, 'goods_id' => $goods->goods_id])->value('attr_value') : '',
                    'price'      => isset($attr_id) ? GoodsAttr::where(['attr_id' => $attr_id, 'goods_id' => $goods->goods_id])->value('attr_price') : $goods->shop_price,
                    'contact_id' => isset($contact->id) ? $contact->id : 0
                );

                self::where('id', $id[$i])->update($new);
            }

        }

        return true;
    }

    public static function checkout(array $attributes)
    {
        extract($attributes);

        $id = json_decode($id,true);
        $id = $id['id'];

        // 获取购物车信息
        $cart = self::whereIn('id', $id)->where('skey', session('key'))->get();
        if (empty($cart->toArray())) { return false; }

        // 判断登录状态
        $user_id = 0;

        // 插入order_info
        $order = array(
            'order_sn'        => Order::make_order_sn(),
            'order_status'    => Order::OS_UNCONFIRMED,
            'user_id'         => $user_id,
            'pay_status'      => Order::PS_UNPAYED,
            'order_number'    => self::whereIn('id', $id)->where('skey', session('key'))->sum('price'),
            'add_time'        => time(),
            'pay_time'        => 0,
            'contact_id'      => $cart[0]['contact_id'],
            'skey'            => session('key'),
        );

        // 循环插入order_goods
        $order_id = Order::insertGetId($order);
        foreach ($cart as $key => $cart_good) {
            $order_good                 = new OrderGoods;
            $order_good->order_id       = $order_id;
            $order_good->goods_id       = $cart_good->goods_id;
            $order_good->goods_name     = $cart_good->goods_name;
            $order_good->goods_number   = $cart_good->number;
            $order_good->goods_price    = $cart_good->price;
            $order_good->goods_attr     = $cart_good->attr_value;
            $order_good->goods_attr_id  = $cart_good->attr_id;
            $order_good->save();
        }

        // 清空购物车
        self::clear_cart_ids($id);

        return true;
    }

    public static function clear_cart_ids($arr = null)
    {
        if (empty($arr))
        {
            self::where('skey', session('key'))->delete();
        }
        else
        {
            self::whereIn('id',$arr)->where('skey', session('key'))->delete();
        }
        return true;
    }
}
