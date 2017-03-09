<?php
class index_control extends init_control
{
    public function _initialize()
    {
        parent::_initialize();
        $this->service = $this->load->service('goods/goods_sku');
        $this->sku_db = $this->load->table('goods/goods_sku');
        $this->goods_service = $this->load->service('goods/goods_spu');
        $this->spu_db = $this->load->table('goods/goods_spu');
        $this->cate_db = $this->load->table('goods/goods_category');
        $this->cate_service = $this->load->service('goods/goods_category');
        $this->type_service = $this->load->service('goods/type');
        $this->goods_category = cache('goods_category');
        $this->brand_service = $this->load->service('goods/brand');
        $this->favorite_service = $this->load->service('member/member_favorite');
        $this->api = $this->load->service('goods/api');
        $this->nav_service = $this->load->service('misc/navigation');
        $this->model = model('misc/article');
        $this->setting = $this->load->table('admin/setting');
        $this->member_model = $this->load->table('member/member');
        $this->wechat = $this->load->service('member/wechatapi');
        $this->article_model = model('misc/article');
        $this->article = $this->load->service('article');
        $this->memcache = $this->load->service('goods/memcache');
    }

    public function index()
    {
        //微信静默授权返回跳转
        if($_GET['state']){
            showmessage('', url('goods/index/' . $_GET['state'] . '',array('code'=>$_GET['code'])), 1);
        }

        $setting = cache('setting', '', 'common');
        $seos = $setting['seos'];
        $site_title = $setting['site_name'] ;
        $site_keywords = $seos['header_keywords'];
        $site_description = $seos['header_description'];
        $site_rewrite_other = $seos['header_other'];
        $SEO = seo($site_title, $site_keywords, $site_description, $site_rewrite_other, true);

        //同步酒店信息
//        $syncHotel = $this->api->webSyncHotel();

//        $cat_where['status'] = 1;
//        $goods_caty = $this->cate_db->where($cat_where)->select();

        $where['is_hotel'] = 1 ;
        $cityJson = $this->memcache->get('city');
        $city = json_decode($cityJson ,true);
        if( !$city ) {
            $city = model('admin/district')->where($where)->order('sort ASC')->select();
            $data = json_encode($city);
            $this->memcache->set( 'city', $data, false, 1200 );
        }



        $this->load->librarys('View')->assign('city' , $city);
//        $this->load->librarys('View')->assign('caty' , $goods_caty);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->assign('setting',$setting);
        $this->load->librarys('View')->display('index');
    }

    /*
     * 手机端搜索酒店
     * **/
    public function booking(){

        //查询已经开业的酒店
        $map['status'] = 1;
        $map['is_hotel'] = 1;
        $map['is_open'] = 1;
        $hotelListJson = $this->memcache->get('m-hotelList');
        $hotelList = json_decode($hotelListJson,true);
        if( empty($hotelList) ){
            $hotelList = $this->spu_db->where($map)->select();
            $hotelListJson = json_encode($hotelList);
            $this->memcache->set( 'm-hotelList', $hotelListJson, false, 1200 );
        }

        $this->load->librarys('View')->assign('hotelList',$hotelList);
        $this->load->librarys('View')->display('booking');
    }

    /*
     * 手机端
     * 从酒店列表下预订
     * **/
    public function hotelListBooking(){
        //从酒店列表过来查询绿云系统的酒店ID
        $get = $_GET;
        if($get['hid']){
            $hid = $get['hid'];
            $map['id'] = $hid;
            $type = $hid;
            $hotelMsgJson = $this->memcache->get('hotelMsg'.$type);
            $hotelMsg = json_decode($hotelMsgJson,true);
        }else if($get['hotelname']){
            $hotelname = $get['hotelname'];
            $map['name'] = $hotelname;
            $type = $hotelname;
            $hotelMsgJson = $this->memcache->get('hotelMsg'.$type);
            $hotelMsg = json_decode($hotelMsgJson,true);
        }
        if( empty($hotelMsg) ){
            $hotelMsg = $this->spu_db->where($map)->find();
            $hotelMsgJson = json_encode($hotelMsg);
            $this->memcache->set( 'hotelMsg'.$type, $hotelMsgJson,false );
        }

        $name = $hotelMsg['name'];
        $rc = $get['rc'];
        $rtype = $this->api->resultApi($rc);

        $lvyunHotel = $this->memcache->get( 'lvyunHotelList' );
        $hlist = json_decode( $lvyunHotel, true );
        if( !$hlist ){
            $hlist = $this->api->webSyncHotel();
            $data = json_encode($hlist);
            $this->memcache->set('lvyunHotelList', $data, false, 1200);
        }
        $nameList = $hlist['hotelList'];
        foreach($nameList as $k=>$v){
            if($nameList[$k]['descript'] == $name){
                $hotelIds = $nameList[$k]['id'];
            }
        }
        $this->load->librarys('View')->assign('hotelIds' , $hotelIds);
        $this->load->librarys('View')->assign('rtype' , $rtype);
        $this->load->librarys('View')->display('hotelListBooking');
    }

    /*
     * 手机端
     * 酒店名称改变 查询酒店下的房间型号
     * **/
    public function selectRoom(){
        //查询酒店绿云系统的ID
        $name = $_POST['name'];
        $subtitle = $_POST['subtitle'];
        $lvyunHotel = $this->memcache->get( 'lvyunHotelList' );
        $hlist = json_decode( $lvyunHotel, true );
        if( !$hlist ){
            $hlist = $this->api->webSyncHotel();
            $data = json_encode($hlist);
            $this->memcache->set('lvyunHotelList', $data, false, 1200);
        }
        $nameList = $hlist['hotelList'];
        foreach($nameList as $k=>$v){
            if($nameList[$k]['descript'] == $name){
                $hotelIds = $nameList[$k]['id'];
                $hid = $nameList[$k]['id'];
            }
        }

        //查询酒店房型
        $datas['date'] = date('Y-m-d',time());
        $datas['dayCount'] = 1;
        $datas['cityCode'] = $subtitle;
        $datas['brandCode'] = '';
        $datas['hotelIds'] = $hotelIds;
        $result = $this->api->quertHotelList($datas);
        if($result['resultCode'] !=0){
            echo json_encode($result['resultMsg']);
            exit;
        }
        $roomList = $result['hrList'][0]['roomList'];
        $rmtype = $result['hrList'][0]['rmtypes'];
        if($hotelIds = 4 && $rmtype[0]['code'] == 'V3L'){
            $tm = $rmtype;
            $rmtype[0]['code'] = $tm[1]['code'];
            $rmtype[0]['descript'] = $tm[1]['descript'];
            $rmtype[1]['code'] = $tm[0]['code'];
            $rmtype[1]['descript'] = $tm[0]['descript'];
        }
        $msg[0] = $this->api->resultApi($roomList,$rmtype);
        $msg[1]=$hid;
        echo json_encode($msg);
    }



    /**
     * [lists 酒店列表]
     * @param  [type] $id [分类id]
     * @return [type]     [description]
     */
    public function lists()
    {
        $post = $_POST;
        $get = $_GET;

        $id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
        $cityCode = $_POST['citys'] ? $_POST['citys'] : ($_POST['nav-citys'] ? $_POST['nav-citys'] : $_POST['list-citys']);
        /*
         * 不知道哪里执行这段代码
         * if($get['city']){
            $cityCode = $get['city'];
        }*/
        $sort = $_GET['sort'];
        $order = str_replace(',',' ',$sort);

        if($id){
            $map['catid'] = $id;
        }
        if($cityCode){
            $map['subtitle'] = $cityCode;
        }
        $map['status'] = 1;
        $map['is_hotel'] = 1;

        $hotelList = $this->spu_db->where($map)->order($order)->select();


        if(!$hotelList){
            showmessage($get['city'].'的酒店正在筹备中。。。', url('index'));
        }
        if(count($hotelList)>1){
            foreach($hotelList as $k=>$v){
                $name[] = $hotelList[$k]['name'];
            }
        }else{
            $name = $hotelList[0]['name'];
        }

        $lvyunHotel = $this->memcache->get('lvyunHotelList');
        $hlist = json_decode( $lvyunHotel, true );
        if( empty($hlist) ){
            $hlist = $this->api->webSyncHotel();
            $datas = json_encode($hlist);
            $this->memcache->set('lvyunHotelList', $datas, false, 1200);
        }

        $nameList = $hlist['hotelList'];
        foreach($nameList as $k=>$v){
            //如果旗下酒店不止1个就要把酒店名称设置为数组
            if(is_array($name)){
                for($i=0;$i<count($name);$i++){
                    if($nameList[$k]['descript'] == $name[$i]){
                        $hotelIds[] = $nameList[$k]['id'];
                    }
                }
            }else{
                if($nameList[$k]['descript'] == $name){
                    $hotelIds = $nameList[$k]['id'];
                }
            }
        }
        //查询已开酒店地址
        $where['is_hotel'] = 1 ;
        $cityJson = $this->memcache->get('city');
        $city = json_decode($cityJson ,true);
        if( !$city ) {
            $city = model('admin/district')->where($where)->order('sort ASC')->select();
            $datas = json_encode($city);
            $this->memcache->set( 'city', $datas, false, 1200 );
        }


        /* 如果旗下品牌的酒店不止一个 进行多次查询
         * 从旗下品牌进来查询
         */
        if(!$post){
            if($hotelIds){
                if(is_array($hotelIds)){
                    for($j=0;$j<count($hotelIds);$j++){
                        $data['date'] = date('Y-m-d',time());
                        $data['dayCount'] = 1;
                        $data['cityCode'] = $hotelList[$j]['subtitle'];
                        $data['brandCode'] = '';
                        $data['hotelIds'] = $hotelIds[$j];
                        $result = $this->api->quertHotelList($data);
                        if($result['resultCode'] !=0){
                            showmessage($result['resultMsg'], url('index'));
                        }
                        $roomList = $result['hrList'][0]['roomList'];
                        $rmtype = $result['hrList'][0]['rmtypes'];
                        if($hotelIds[0] = 4 && $rmtype[0]['code'] == 'V3L'){
                            $tm = $rmtype;
                            $rmtype[0]['code'] = $tm[1]['code'];
                            $rmtype[0]['descript'] = $tm[1]['descript'];
                            $rmtype[1]['code'] = $tm[0]['code'];
                            $rmtype[1]['descript'] = $tm[0]['descript'];
                        }
                        $minprice[] = $result['hrList'][0]['minRate'];
                        $msg[] = $this->api->resultApi($roomList,$rmtype);
                    }

                }else{
                    //旗下的酒店只有一个
                    $data['date'] = date('Y-m-d',time());
                    $data['dayCount'] = 1;
                    $data['cityCode'] = $hotelList[0]['subtitle'];
                    $data['brandCode'] = '';
                    $data['hotelIds'] = $hotelIds;
                    $result = $this->api->quertHotelList($data);
                    if($result['resultCode'] !=0){
                        showmessage($result['resultMsg'], url('index'));
                    }
                    $roomList = $result['hrList'][0]['roomList'];
                    $rmtype = $result['hrList'][0]['rmtypes'];
                    if($hotelIds = 4 && $rmtype[0]['code'] == 'V3L'){
                        $tm = $rmtype;
                        $rmtype[0]['code'] = $tm[1]['code'];
                        $rmtype[0]['descript'] = $tm[1]['descript'];
                        $rmtype[1]['code'] = $tm[0]['code'];
                        $rmtype[1]['descript'] = $tm[0]['descript'];
                    }
                    $msg = $this->api->resultApi($roomList,$rmtype);
                    $msg[0]['st'] = 'd';        //此字段没用 只是区分是否只有一个酒店
                }
            }
        }


        //首页导航下 轮播图 列表页  快速查询房价

        if($hotelIds){
            if($_POST['citys'] || $_POST['nav-citys'] || $_POST['list-citys']){
                $checkout_time = $_POST['checkout-time'];
                $check_time = $_POST['check-time'];
                $co_time = strtotime($checkout_time);
                $c_time = strtotime($check_time);
                $time = ($co_time - $c_time) / (60*60*24);
                $data['date'] = $_POST['check-time'];
                $data['dayCount'] = $time < 1 ? 1 : $time;
                $data['cityCode'] = $cityCode;
                $data['brandCode'] = '';
                $data['hotelIds'] = $hotelIds;
                $result = $this->api->quertHotelList($data);
                if($result['resultCode'] !=0){
                    showmessage($result['resultMsg'], url('index'));
                }
                $roomList = $result['hrList'][0]['roomList'];
                $rmtype = $result['hrList'][0]['rmtypes'];
                if($hotelIds = 4 && $rmtype[0]['code'] == 'V3L'){
                    $tm = $rmtype;
                    $rmtype[0]['code'] = $tm[1]['code'];
                    $rmtype[0]['descript'] = $tm[1]['descript'];
                    $rmtype[1]['code'] = $tm[0]['code'];
                    $rmtype[1]['descript'] = $tm[0]['descript'];
                }
                $msg = $this->api->resultApi($roomList,$rmtype);
                $msg[0]['st'] = 'd';

            }
        }

        /*添加旗下是否有不止1个酒店*/
        if(empty($msg[0]['st'])){
            //如果旗下酒店不止1个就用酒店信息遍历
            foreach($hotelList as $k=>$v){
                $hotelList[$k]['msg'] = $msg[$k];
                $hotelList[$k]['minp'] = $minprice[$k];
            }
        }else{
            $this->load->librarys('View')->assign('minPrice' , $result['hrList'][0]['minRate']);
        }


        $this->load->librarys('View')->assign('post' , $post);
        $this->load->librarys('View')->assign('msg' , $msg);
        $this->load->librarys('View')->assign('hotelNum' , $result['totalRows']);
        $result = $this->service->create_sqlmap($_GET);
        $this->load->librarys('View')->assign('city' , $city);
        $this->load->librarys('View')->assign('hotelList',$hotelList);
        $this->load->librarys('View')->assign('hotelListNum',count($hotelList));
        $this->load->librarys('View')->assign('result',$result);
        $this->load->librarys('View')->display('lists');
    }


    /*
     * 酒店品牌列表
     * */
    public function pinpai(){

        $where['status'] = 1;
        $where['is_hotel'] = 1;

        $hotelListJson = $this->memcache->get( 'pinpaiHotelList' );
        $hotelList = json_decode($hotelListJson ,true);
        if( empty($hotelList) ) {
            $result = $this->spu_db->where($where)->order('sort asc')->select();
            $hotelList = array();
            foreach($result as $k=>$v){
                $result[$k]['imgs'] = json_decode($result[$k]['imgs'],true);
                if(count($result[$k]['imgs']) > 1){
                    $hotelList[$k]['id'] = $result[$k]['id'];
                    $hotelList[$k]['catid'] = $result[$k]['catid'];
                    for($i=3;$i<count($result[$k]['imgs']);$i++){
                        $hotelList[$k]['lb'][] = $result[$k]['imgs'][$i];
                    }
                    $hotelList[$k]['imgs'] = $result[$k]['imgs'];               //图库
                    $hotelList[$k]['hotel_content'] = explode('<br/>',$result[$k]['hotel_class_content']);
                    $hotelList[$k]['subtitle'] = $result[$k]['subtitle'];       //城市代码
                    $hotelList[$k]['maodian'] = $result[$k]['subtitle'].'M';    //锚点
                    $hotelList[$k]['is_open'] = $result[$k]['is_open'];         //是否营业

                }
                $hotels = array();
            }

            foreach($result as $k=>$v){
                foreach($hotelList as $key=>$val){
                    if($result[$k]['catid'] == $hotelList[$key]['catid']){
                        $hotelList[$key]['hotelList'][] = $result[$k];
                    }
                }
            }

            $mhotelList = json_encode( $hotelList );
            $this->memcache->set( 'pinpaiHotelList', $mhotelList, false );
        }

        $this->load->librarys('View')->assign('hotel_class',$hotelList);
        $this->load->librarys('View')->display('pinpai');
    }

    /*
     * 手机端
     * 酒店品牌列表
     * **/
    public function mobilePinPai(){

        $map = array();
        $map['is_hotel'] = 1;
        $map['status'] = 1;
        $pinpaiJson = $this->memcache->get('m-pinpai');
        $cat_hotel_list = json_decode($pinpaiJson, true);
        if( empty($cat_hotel_list) ){
            $cat = $this->cate_db->where($map)->order('sort asc')->select();

            $cat_hotel_list = array();
            foreach($cat as $k=>$v){
                $cat_hotel_list[md5($cat[$k]['id'])]['cat'] = $cat[$k];
                unset($cat[$k]);
            }

            $where = array();
            $where['is_hotel'] = 1;
            $where['status'] = 1;
            $hotel = $this->spu_db->where($where)->select();
            foreach($hotel as $k=>$v){
                $cat_hotel_list[md5($hotel[$k]['catid'])]['hotel'][] = $hotel[$k];
                unset($hotel[$k]);
            }

            foreach($cat_hotel_list as $k=>$v){
                if($cat_hotel_list[$k]['cat']['name'] == '宝龙旗下酒店'){
                    unset($cat_hotel_list[$k]);
                }
            }

            $pinpaiJson = json_encode($cat_hotel_list);
            $this->memcache->set( 'm-pinpai', $pinpaiJson, false );
        }


        $this->load->librarys('View')->assign('catHotelList',$cat_hotel_list);
        $this->load->librarys('View')->display('pinpai');
    }

    /*
     * 查询地址
     * **/
    public function selectAdd(){

        $pinyin = $_POST['name'];
        if(!$pinyin){exit;}
        $starp = substr($pinyin,0,1);
        $file = fopen( DOC_ROOT . 'caches/'.$starp, 'a+'); //打开或创建文件
        $fileresult = file_get_contents( DOC_ROOT . 'caches/'.$starp, 'a+');  //如果文件是空的 去查询 否则读取文件

        if($file && $fileresult){
            $fileData = json_decode($fileresult,true);
            $arr = array();
            foreach($fileData as $k=>$v){
                $dataPinyin = $fileData[$k]['pinyin'];
                if(substr_count($dataPinyin,$pinyin)){
                    $arr[]=$fileData[$k];
                }
            }
            if($arr){
                echo json_encode($arr);exit;
            }
        }

        $where['level'] = 2;
        $where['pinyin'] = array('like',$starp.'%');
        $city = model('admin/district')->where($where)->select();
        $writeContent = json_encode($city);
        $file = fopen( DOC_ROOT . 'caches/'.$starp, 'w+');
        fwrite($file,$writeContent);
        fclose($file);
        $arr = array();
        foreach($city as $k=>$v){
            $dataPinyin = $city[$k]['pinyin'];
            if(substr_count($dataPinyin,$pinyin)){
                $arr[]=$city[$k];
            }
        }
        echo json_encode($arr);exit;

    }

    /**
     * [detail 酒店详情页]
     * @param  [type] $id [商品id]
     * @return [type] [description]
     */
    public function hotelDetail()
    {
        $id = $_GET['sid'];
        $where['id'] = $id;
        $hotelJson = $this->memcache->get('hotelMsg'.$id);
        $hotel = json_decode($hotelJson,true);
        if( empty($hotel) ){
            $hotel = $this->spu_db->where($where)->select();
            $hotelJson = json_encode($hotel);
            $this->memcache->set( 'hotelMsg'.$id , $hotelJson, false );
        }

        $name = $hotel[0]['name'];

        $lvYunJson = $this->memcache->get( 'lvyunHotelList' );
        $hotelList = json_decode( $lvYunJson, true );
        if( empty($hotelList) ){
            $hotelList = $this->api->webSyncHotel();
            $datas = json_encode($hotelList);
            $this->memcache->set('lvyunHotelList', $datas, false, 1200);
        }


        $nameList = $hotelList['hotelList'];
        foreach($nameList as $k=>$v){
            if($nameList[$k]['descript'] == $name){
                $hotelIds = $nameList[$k]['id'];
            }
        }

        //查询价格
        $data['hotelIds'] = $hotelIds;
        $data['date'] = date('Y-m-d',time());
        $data['dayCount'] = 1;
        $data['cityCode'] = $hotel[0]['subtitle'];
        $data['brandCode'] = '';
        $result = $this->api->quertHotelList($data);
        $roomList = $result['hrList'][0]['roomList'];
        $rmtype = $result['hrList'][0]['rmtypes'];
//        if($hotelIds = 4){
//            $tm = $rmtype;
//            $rmtype[0]['code'] = $tm[1]['code'];
//            $rmtype[0]['descript'] = $tm[1]['descript'];
//            $rmtype[1]['code'] = $tm[0]['code'];
//            $rmtype[1]['descript'] = $tm[0]['descript'];
//        }
        $data = $this->api->resultApi($roomList,$rmtype);   //处理房型
        $msg = $this->api->breakfast($data);                //处理早餐
        $imgsrc = __ROOT__ . "template/default/statics/images/";
        $this->load->librarys('View')->assign('imgsrc',$imgsrc);
        $this->load->librarys('View')->assign('result',$result);
        $this->load->librarys('View')->assign('msg',$msg);
        $this->load->librarys('View')->assign('hotel', $hotel[0]);
        $this->load->librarys('View')->display('detail');
    }

    /*
     * AJAX 获取房型信息
     * **/
    public function ajax_room_price(){
        $room_type = $_POST['rmtype'];
        $checkout_time = $_POST['checkout_time'];
        $check_time = $_POST['check_time'];
        $co_time = strtotime($checkout_time);
        $c_time = strtotime($check_time);
        $time = ($co_time - $c_time) / (60*60*24);
        $data['date'] = $_POST['check_time'];
        $data['dayCount'] = $time < 1 ? 1 : $time;
        $data['cityCode'] = $_POST['cityCode'];
        $data['brandCode'] = '';
        $data['hotelIds'] = $_POST['hotelIds'];
        $data['rateCode'] = $_SESSION['userInfo']['rateCode'];
        $result = $this->api->rateQueryEveryDay($data);
        if($result['rateCode'] != 0){
            echo false;
            exit;
        }
        $roomList = $result['queryResult'];
        $roomtype = array();
        foreach($roomList as $k=>$v){
            $roomtype[$k]['code'] = $roomList[$k]['rmtype'];
        }
        $msg = $this->api->resultApi($roomList,$roomtype);

        $hotel_room_msg = array();
        foreach($msg as $k => $v){
            if($msg[$k]['rmtype'] == $room_type){
                $hotel_room_msg = $msg[$k];
            }
        }
        echo json_encode($hotel_room_msg);
    }


    /*
     * 艺术品商城首页
     * **/
    public function totalArt(){

        $navJson = $this->memcache->get( 'artNav' );
        $nav = json_decode( $navJson,true );
        if( empty($nav) ){
            $where['display'] = '1';
            $nav = model('navigation')->where($where)->select();
            $datas = json_encode( $nav );
            $this->memcache->set( 'artNav', $datas, false, 1500 );
        }

        //商品
        $whereg['is_hotel'] = 0;
        $whereg['is_index'] = 1;
        $whereg['is_derivative'] = 0;
        $whereg['status'] = 1;
        $order = 'sort ASC';

        $goodsJson = $this->memcache->get( 'artIndex' );
        $goods = json_decode( $goodsJson,true );
        if( empty($goods) ){
            $goods = $this->spu_db->where($whereg)->order($order)->select();
            $datas = json_encode( $goods );
            $this->memcache->set( 'artIndex', $datas, false, 180 );
        }


        $SEO = 'totalArt';
        $this->load->librarys('View')->assign('goods',$goods);
        $this->load->librarys('View')->assign('artNav',$nav);
        $this->load->librarys('View')->display('totalart');
    }

    /*
     * 艺术品 & 作家
     * **/
    public function works(){
        $post = $_POST;
        $get = $_GET;

        if( empty($get['id']) || empty($post['id']) ){     //非点击作家头像 查作品

            /*搜索条件名字*/
            if($get['artname']){
                $spuid = $this->brand_service->ajax_brand($get['artname']);
                $searcharr = array();
                foreach($spuid as $k=>$v){
                    $searcharr[] = $k;
                }
                $where['brand_id'] = array('IN',$searcharr);
            }
            /*默认显示*/
            $where['is_hotel'] = 0;
            $where['is_derivative'] = 0;
            $where['status'] = 1;

            if(!empty($get['catid'])){
                $where['catid'] = $get['catid'];         //根据品类去查
            }
            if(!empty($get['prices'])) {
                switch ($get['prices']) {
                    case 1:
                        $price = false;
                        break;
                    case 2:
                        $price = '100,299';
                        break;
                    case 3:
                        $price = '300,599';
                        break;
                    case 4:
                        $price = '600,999';
                        break;
                    case 5:
                        $price = '1000,2999';
                        break;
                    case 6:
                        $price = '3000';
                        break;
                }
                if($price){
                    if(strpos($price , ',')){
                        $where['max_price'] = array( 'BETWEEN' , $price);
                    }else{
                        $where['max_price'] = array('EGT',$price);
                    }
                }

            }

            $limit = $this->ajax_limit( $get['load'] , $get['page'] );

            //memcache 带上搜索的条件 以免取数据 取错
            $picJson = $this->memcache->get('pic' . $get['load'] . $limit . $price . $get['catid'] . $get['artname'] );
            $pic = json_decode( $picJson, true );
            if( empty($pic) ){
                $pic = $this->spu_db->where($where)->order('sort ASC')->limit( $limit )->select();
                $picJson = json_encode($pic);
                $this->memcache->set( 'pic' . $get['load'] . $limit . $price . $get['catid'] . $get['artname'] ,$picJson, false );
            }
            if( $pic && empty( $get['types'] ) ){
                if( empty( $_SESSION['yshuPic']) ){
                    $_SESSION['yshuPic'] = $pic;
                }else{
                    $_SESSION['yshuPic'] = array_merge_recursive( $_SESSION['yshuPic'], $pic );
                }
            }


            //如果是下拉加载就退出
            if( $get['load'] == '1' ){
                echo json_encode( $pic );
                return;
            }

        }else{
            /*查询作家的作品*/
            $bid = $get['id'];
            $where['brand_id'] = $bid;
            $where['is_hotel'] = 0;
            $where['status'] = 1;

            $ajaxDateJson = $this->memcache->get('ajaxWorks'.$bid);
            $ajaxDate = json_decode($ajaxDateJson ,true);
            if( empty($ajaxDate) ){
                $ajaxDate = $this->spu_db->where($where)->order('sort DESC')->select();
                $ajaxDateJson = json_encode( $ajaxDate );
                $this->memcache->set( 'ajaxWorks'.$bid , $ajaxDateJson, false);
            }
            if(empty($ajaxDate)){
                echo false;
                return;
            }else{
                echo json_encode($ajaxDate);
                return;
            }
        }

        //查询作家
        $artistJson = $this->memcache->get('artist');
        $artist = json_decode( $artistJson, true );
        if( empty($artist) ){
            $artist = $this->brand_service->get_lists();
            $artistJson = json_encode( $artist );
            $this->memcache->set( 'artist', $artistJson, false );
        }


        //查询艺术品分类
        $where['status'] = 1;
        $where['show_in_nav'] = 1;
        $where['parent_id'] = $get['cid'] ? $get['cid'] : $post['cid'];

        //nav
        $workNavJson = $this->memcache->get( 'workNav' );
        $nav = json_decode( $workNavJson ,true );
        if( empty($nav) ){
            $nav = $this->cate_db->where($where)->order('sort ASC')->select();
            $workNav = json_encode( $nav );
            $this->memcache->set( 'workNav', $workNav, false );
        }

        $this->load->librarys('View')->assign('nav',$nav);
        $this->load->librarys('View')->assign('artist',$artist);
        $this->load->librarys('View')->assign('pic',$pic);
        $this->load->librarys('View')->assign('get',$_GET);
        $this->load->librarys('View')->assign('post',$_POST);
        $this->load->librarys('View')->assign('userInfo',$this->member);
        $this->load->librarys('View')->display('works');
    }

    /*
     * 手机端 艺术家
     * **/
    public function mworks(){
        $artist = $this->brand_service->get_lists(1,6);
        $this->load->librarys('View')->assign('artist',$artist);
        $this->load->librarys('View')->display('martist');
    }

    /*
     * 手机端 下拉或上拉 加载艺术家
     * **/
    public function ajaxWorks(){
        $page = $_GET['page'] ? $_GET['page'] : 1;
        $limit = $_GET['limit'] ? $_GET['limit'] : 6;
        $artist = $this->brand_service->get_lists($page,$limit);
        echo json_encode($artist);
    }

    /*
     * 艺术品详情
     * */
    public function worksDetail(){
        $get = $_GET;
        if($get['sid']){
            $where['spu_id'] = $get['sid'];
            $skid = $this->sku_db->where($where)->select();
            $sku_id = $skid[0]['sku_id'];
        }else{
            $sku_id = $get['sku_id'];
        }
        $goodsJson = $this->memcache->get( 'goods'.$sku_id );
        $goods = json_decode( $goodsJson,true );
        if( empty($goods) ){
            $goods = $this->service->detail($sku_id, FALSE);
            $goodsJson = json_encode($goods);
            $this->memcache->set( 'goods'.$sku_id, $goodsJson, false, 180 );
        }

        if (!$goods) {
            showmessage($this->service->error, url('index'));
        }
        if ($goods['prom_type'] == 'goods' && $goods['prom_id'] > 0) {
            $goods_proms = model('promotion/promotion_goods')->where(array('id' => $goods['prom_id']))->find();
            $counts = 0;
            foreach ($goods_proms['rules'] as $key => $value) {
                if($value) $counts++;
                switch ($value['type']) {
                    case 'amount_discount':
                        $type = '满额立减';
                        break;
                    case 'number_discount':
                        $type = '满件立减';
                        break;
                    case 'amount_give':
                        $type = '满额送礼';
                        break;
                    case 'number_give':
                        $type = '满件送礼';
                        break;
                    default:
                        break;
                }
                $goods_proms['rules'][$key]['subtitle'] = $type;
            }
            $this->load->librarys('View')->assign('counts',$counts);
            $this->load->librarys('View')->assign('goods_proms',$goods_proms);
        }
//        $count = model('comment/comment', 'service')->get_count($goods['spu_id']);
        $title = $goods['sku_name'] . ' - ' . $goods['cat_name'];
        $SEO = seo($title, $goods['keyword'], $goods['description']);
        $this->service->_history($sku_id);
        $this->service->inc_hits($sku_id);

        //添加的后期处理字符串
        $goods['brand']['write_view'] = str_replace('<br/>','',$goods['brand']['write_view']);
        $spec = json_decode($goods['spec'],true);
        $goods['specarr'] = $spec;
        $goods['size_texture'] = explode('|',$spec[0]['value']);
        $specnames = explode('&',$spec[0]['name']);
        if(is_array($specnames)){
            $goods['specnames'] = $specnames;
        }else{
            $goods['specnames'] = $spec[0]['name'];
        }
        //查询酒店信息
        $maps['name'] = $goods['hotel_name'];
        $maps['is_hotel'] = 1;
        $maps['status'] = 1;
        $hotelmsg = $this->spu_db->where($maps)->select();
        $goods['hotelmsg'] = $hotelmsg[0];
        $setting = $this->load->table('setting')->getField('key,value',TRUE);

        //处理房型 与房型代码
        $roommsg = explode('-',$goods['room_code']);
        $goods['roomtype'] = $roommsg[0];
        $goods['typecode'] = $roommsg[1];
        //有没有加入收藏
        $likes = $this->service->is_favorite($this->member['id'], $goods['sku_id']);

        $this->load->librarys('View')->assign('favorite',$likes);
        $this->load->librarys('View')->assign('setting',$setting);
//        $this->load->librarys('View')->assign('count',$count);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->assign('goods',$goods);
        $this->load->librarys('View')->display('work_detail');
    }


    /*
     * 作家单独页面
     * **/
    public function artist(){
        $get = $_GET;
        //查询艺术家
        $artistJson = $this->memcache->get('artist');
        $artist = json_decode($artistJson ,true);
        if( empty($artist) ){
            $artist = $this->brand_service->get_lists();
            $artistJson = json_encode($artist);
            $this->memcache->set( 'artist', $artistJson,false );
        }


        //处理当前艺术家信息
        $artmsg = array();
        foreach($artist as $k=>$v){
            if($artist[$k]['id'] == $get['id']){
                $artmsg = $artist[$k];
            }
        }

        //艺术家的作品
        $where['is_hotel'] = 0;
        $where['status'] = 1;
        $where['is_derivative'] = 0;
        $where['brand_id'] = $get['id'];

        $worksJson = $this->memcache->get('ajaxWorks'.$get['id']);
        $works = json_decode($worksJson ,true );
        if( empty($works) ){
            $works = $this->spu_db->where($where)->order('sort ASC')->select();
            $worksJson = json_encode($works);
            $this->memcache->set( 'ajaxWorks'.$get['id'] , $worksJson, false);
        }


        foreach($works as $k=>$v){
            $works[$k]['specs'] = json_decode($works[$k]['specs'],true);
        }
        //处理商品规格
        foreach($works as $key=>$val){
            foreach($works[$key]['specs'] as $k=>$v){
                $works[$key]['specs_specs'] = explode('|', $works[$key]['specs'][$k]['value']);
            }
        }

        //文章
        $wherezx['category_id'] = array('IN','1,2');
        $wherezx['display'] = 1;
        $articleNews = $this->model->where($wherezx)->order('sort ASC')->limit('0,3')->select();
        foreach($articleNews as $k=>$v){
            $articleNews[$k]['keywords'] = substr($articleNews[$k]['keywords'],0 ,250) . '......';
        }

        $_SESSION['works'] = $works;
        $this->load->librarys('View')->assign('news',$articleNews);
        $this->load->librarys('View')->assign('works',$works);
        $this->load->librarys('View')->assign('artmsg',$artmsg);
        $this->load->librarys('View')->assign('art',$artist);
        $this->load->librarys('View')->display('artist');
    }

    /*
     * 作家作品展示  手机端显示
     * **/
    public function artZpj(){
        $zp = $_SESSION['works'];
        $this->load->librarys('View')->assign('works',$zp);
        $this->load->librarys('View')->display('art-works');
    }

    /*
     * 作品展示  手机端显示
     * **/
    public function artzp(){
        //艺术家的作品
        $get = $_GET;
        $wheren['status'] = 1;
        $wheren['show_in_nav'] = 1;
        $wheren['parent_id'] = $get['cid'];
        if(empty($_SESSION['yshuNav'])){
            $nav = $this->cate_db->where($wheren)->order('sort ASC')->select();
            $_SESSION['yshuNav'] = $nav;
        }else{
            $nav = $_SESSION['yshuNav'];
        }

        $where['is_hotel'] = 0;
        $where['status'] = 1;
        $where['is_derivative'] = 0;

        if(!empty($get['catid'])){
            $where['catid'] = $get['catid'];         //根据品类去查
        }
        if(!empty($get['prices'])) {
            switch ($get['prices']) {
                case 1:
                    $price = false;
                    break;
                case 2:
                    $price = '100,299';
                    break;
                case 3:
                    $price = '300,599';
                    break;
                case 4:
                    $price = '600,999';
                    break;
                case 5:
                    $price = '1000,2999';
                    break;
                case 6:
                    $price = '3000';
                    break;
            }
            if($price){
                if(strpos($price , ',')){
                    $where['max_price'] = array( 'BETWEEN' , $price);
                }else{
                    $where['max_price'] = array('EGT',$price);
                }
            }

        }
        $limit  = (isset($_GET['limit'])) ? $_GET['limit'] : 6;
        $works = $this->spu_db->where($where)->order('sort ASC')->limit($limit)->select();
        $_SESSION['mWorks'] = $works;
        $this->load->librarys('View')->assign('works',$works);
        $this->load->librarys('View')->assign('nav',$nav);
        $this->load->librarys('View')->assign('get',$get);
        $this->load->librarys('View')->display('art-works-show');
    }

    /*
     * 手机端  下拉刷新以及上拉加载
     * **/
    public function ajaxArtZp(){
        //艺术家的作品
        $where['is_hotel'] = 0;
        $where['status'] = 1;
        $where['is_derivative'] = 0;
        $get = $_GET;
        if(!empty($get['map']['catid'])){
            $where['catid'] = $get['map']['catid'];         //根据品类去查
        }
        if(!empty($get['map']['prices'])) {
            switch ($get['map']['prices']) {
                case 1:
                    $price = false;
                    break;
                case 2:
                    $price = '100,299';
                    break;
                case 3:
                    $price = '300,599';
                    break;
                case 4:
                    $price = '600,999';
                    break;
                case 5:
                    $price = '1000,2999';
                    break;
                case 6:
                    $price = '3000';
                    break;
            }
            if($price){
                if(strpos($price , ',')){
                    $where['max_price'] = array( 'BETWEEN' , $price);
                }else{
                    $where['max_price'] = array('EGT',$price);
                }
            }

        }

        $limit  = (isset($_GET['limit'])) ? $_GET['limit'] : 6;
        $works = $this->spu_db->where($where)->page($_GET['page'])->order('sort ASC')->limit($limit)->select();
        $_SESSION['mWorks'] = $works;
        echo json_encode($works);
    }
    /*
     * 艺术衍生品
     * **/
    public function derivative(){
        $get = $_GET;
        $post = $_POST;
        //查询分类
        $where['status'] = 1;
        $where['show_in_nav'] = 1;
        $where['parent_id'] = $get['cid'];
        $navListJson = $this->memcache->get('yspNav');
        $navList = json_decode($navListJson , true);
        if( empty($navList) ){
            $navList = $this->cate_db->where($where)->order('sort ASC')->select();
            $navListJson = json_encode($navList);
            $this->memcache->set( 'yspNav',$navListJson, false );
        }


        //查询衍生品
        $whereysp['is_derivative'] = 1;     //是衍生品
        $whereysp['is_hotel'] = 0;          //不是酒店
        $whereysp['status'] = 1;            //状态上架
        if(!empty($get['catid'])){
            $whereysp['catid'] = $get['catid'];         //根据品类去查
        }
        if(!empty($get['prices'])) {
            switch ($get['prices']) {
                case 1:
                    $price = false;
                    break;
                case 2:
                    $price = '100,299';
                    break;
                case 3:
                    $price = '300,599';
                    break;
                case 4:
                    $price = '600,999';
                    break;
                case 5:
                    $price = '1000,2999';
                    break;
                case 6:
                    $price = '3000';
                    break;
            }
            if($price){
                if(strpos($price , ',')){
                    $whereysp['max_price'] = array( 'BETWEEN' , $price);
                }else{
                    $whereysp['max_price'] = array('EGT',$price);
                }
            }

        }

        if(!empty($post['search'])){
            $whereysp['name'] = array("LIKE", "%".$post['search']."%");
        }
        if( empty($whereysp['max_price']) && empty($whereysp['catid']) ){
            $derivativeJson = $this->memcache->get('yspList');
            $derivative = json_decode($derivativeJson ,true);
            if( empty($derivative) ){
                $derivative = $this->spu_db->where($whereysp)->order('sort ASC')->limit('0,50')->select();

                //查询SKU_ID 与 酒店信息
                foreach($derivative as $k=>$v){
                    $map['spu_id'] = $derivative[$k]['id'];
                    $skur = $this->sku_db->where($map)->select();

                    $where['name'] = $derivative[$k]['hotel_name'];
                    $where['is_hotel'] = 1;
                    $where['status'] = 1;
                    $hotelmsg = $this->spu_db->where($where)->select();

                    $derivative[$k]['sku_id'] = $skur[0]['sku_id'];
                    $derivative[$k]['hotelmsg'] = $hotelmsg[0];
                    $derivative[$k]['imgs'] = json_decode($derivative[$k]['imgs'],true);
                    //处理房型 与房型代码
                    $roommsg = explode('-',$derivative[$k]['room_code']);
                    $derivative[$k]['roomtype'] = $roommsg[0];
                    $derivative[$k]['typecode'] = $roommsg[1];
                }

                $derivativeJson = json_encode($derivative);
                $this->memcache->set( 'yspList',$derivativeJson, false );
            }
        }else{
            $derivative = $this->spu_db->where($whereysp)->order('sort ASC')->select();
            //查询SKU_ID 与 酒店信息
            foreach($derivative as $k=>$v){
                $map['spu_id'] = $derivative[$k]['id'];
                $skur = $this->sku_db->where($map)->select();

                $where['name'] = $derivative[$k]['hotel_name'];
                $where['is_hotel'] = 1;
                $where['status'] = 1;
                $hotelmsg = $this->spu_db->where($where)->select();

                $derivative[$k]['sku_id'] = $skur[0]['sku_id'];
                $derivative[$k]['hotelmsg'] = $hotelmsg[0];
                $derivative[$k]['imgs'] = json_decode($derivative[$k]['imgs'],true);
                //处理房型 与房型代码
                $roommsg = explode('-',$derivative[$k]['room_code']);
                $derivative[$k]['roomtype'] = $roommsg[0];
                $derivative[$k]['typecode'] = $roommsg[1];
            }
        }

        if($post['m_s']){
            echo json_encode($derivative);exit;
        }

        //为了不再次查询数据库 存入SESSION 以便价格排序
        $_SESSION['goods_deri'] = $derivative;
        $_SESSION['nav'] = $navList;

        $this->load->librarys('View')->assign('derivative',$derivative);
        $this->load->librarys('View')->assign('nav',$navList);
        $this->load->librarys('View')->assign('get',$_GET);
        $this->load->librarys('View')->display('derivative');
    }

    public function sorts(){

        $artistJson = $this->memcache->get('artist');
        $artist = json_decode( $artistJson, true );

        $workNavJson = $this->memcache->get( 'workNav' );
        $nav = json_decode( $workNavJson ,true );

        if($_GET['types'] == 'yshu'){
            $derivative = $_SESSION['yshuPic'];
        }elseif($_GET['types'] == 'myshu'){
            $derivative = $_SESSION['mWorks'];
            $arrs = array($derivative);
        }else{
            $derivative = $_SESSION['goods_deri'];
            $arrs = array($derivative);
        }


        foreach( $derivative as $k => $v ) {
            $indexWhere['spu_id'] = $derivative[$k]['id'];
//            $indexWhere['brand_id'] = $_GET['bid'];
            $result = $this->load->table('goods_index')->where($indexWhere)->find();
            $derivative[$k]['sales'] = $result['sales'];
            $derivative[$k]['hits'] = $result['hits'];
        }

        $sort = array(
            'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
            'field'     => $_GET['fileds'],       //排序字段
        );
        $arrSort = array();
            foreach($derivative AS $k => $v){
                foreach($v AS $key=>$value){
                    $arrSort[$key][$k] = $value;
                }
            }
            if($sort['direction']){
                array_multisort($arrSort[$sort['field']], constant($sort['direction']), $derivative);
            }

        if($_GET['types'] == 'yshu'){
            $this->load->librarys('View')->assign('nav',$_SESSION['yshuNav']);
            $this->load->librarys('View')->assign('artist',$_SESSION['yshuArtist']);
            $this->load->librarys('View')->assign('pic',$derivative);
            $this->load->librarys('View')->assign('userInfo',$this->member);
            $this->load->librarys('View')->assign('get', $_GET);
            $this->load->librarys('View')->assign('artist',$artist);
            $this->load->librarys('View')->assign('nav',$nav);
            $this->load->librarys('View')->display('works');
        }elseif($_GET['types'] == 'myshu'){
            $this->load->librarys('View')->assign('works',$derivative);
            $this->load->librarys('View')->assign('nav',$_SESSION['yshuNav']);
            $this->load->librarys('View')->assign('get',$_GET);
            $this->load->librarys('View')->assign('artist',$artist);
            $this->load->librarys('View')->assign('nav',$nav);
            $this->load->librarys('View')->display('art-works-show');
        }else {
            $this->load->librarys('View')->assign('derivative', $derivative);
            $this->load->librarys('View')->assign('nav', $_SESSION['nav']);
            $this->load->librarys('View')->assign('get', $_GET);
            $this->load->librarys('View')->assign('artist',$artist);
            $this->load->librarys('View')->assign('nav',$nav);
            $this->load->librarys('View')->display(derivative);
        }
    }
    
    /*
     * 会员专享
     * **/
    public function vip(){
        $SEO['title'] = '会员专享';
        $get = $_GET;
        $this->load->librarys('View')->assign('SEO',$SEO);
        switch($get['pages']){
            case 'gaishu' :
                $this->load->librarys('View')->display('gaishu');
                break;
            case 'vip' :
                $this->load->librarys('View')->display('viplevel');
                break;
            case 'quanyi' :
                $this->load->librarys('View')->display('quanyi');
                break;
            case 'zhangcheng' :
                $this->load->librarys('View')->display('zhangcheng');
                break;
            default:
                $this->load->librarys('View')->display('vip');
                break;
        }
    }


    /*
     * 关于我们
     * */
    public function about(){
        $SEO['title'] = '关于我们';

        //新闻
        $wherezx['category_id'] = 4;
        $wherezx['display'] = 1;
        $articleNewsJson = $this->memcache->get('articleNews');
        $articleNews = json_decode($articleNewsJson, true);
        if( empty($articleNews) ){
            $articleNews = $this->article_model->where($wherezx)->order('sort ASC')->select();
            $articleNewsJson = json_encode($articleNews);
            $this->memcache->set( 'articleNews', $articleNewsJson, false, 1200 );
        }


        //招聘
        $wherezx['category_id'] = 5;
        $wherezx['display'] = 1;
        $zpJson = $this->memcache->get('zhaopin');
        $zp = json_decode($zpJson,true);
        if( empty($zp) ){
            $zp = $this->article_model->where($wherezx)->order('sort ASC')->select();
            $zpJson = json_encode($zp);
            $this->memcache->set( 'zhaopin', $zpJson, false, 1200 );
        }




        $this->load->librarys('View')->assign('zp',$zp);
        $this->load->librarys('View')->assign('news',$articleNews);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('about');
    }

    /*
     * 关于我们下的文章详情
     * **/
    public function article_detail(){
        $id = (int) $_GET['id'];
        $rowJson = $this->memcache->get('wenzhang'.$id);
        $row = json_decode($rowJson,true);
        if( empty($row) ){
            $row = $this->article->get_article_by_id($id);
            $rowJson = json_encode($row);
            $this->memcache->set( 'wenzhang'.$id, $rowJson, false );
        }

        if(!$row) {
            showmessage(lang('misc/article_not_exist'));
        }
        $this->article->hits($id);
        $row['hits'] += 1;
        extract($row);
        $this->load->librarys('View')->assign($row,$row);
        $this->load->librarys('View')->display('article_detail');
    }


    /*
     *  微信菜单链接 获取Code  weChat Menus
     * */
    public function weChatMenu(){
        switch($_GET['menu']){
            case 'message':
                $callBackUrl = 'http://new.artels.cn/index.php?m=goods&c=index&a=message';      //我的信息
                $state = 'message';
                break;
            case 'order':
                $callBackUrl = 'http://new.artels.cn/index.php?m=goods&c=index&a=order';        //预订列表
                $state = 'order';
                break;
            case 'integral':
                $callBackUrl = 'http://new.artels.cn/index.php?m=goods&c=index&a=integral';     //我的积分
                $state = 'integral';
                break;
            case 'resetpwd':
                $callBackUrl = 'http://new.artels.cn/index.php?m=goods&c=index&a=resetpwd';     //密码修改
                $state = 'resetPwd';
                break;
        }

        $this->wechat->getCodeSilence($callBackUrl,$state);
    }

    /*
     * 我的信息 weChat Menus
     * **/
    public function message(){
        $code = $_GET['code'];
        $user = $this->getOpenid($code);
        if(!$user){
            showmessage('', url('member/public/wechatlogin'), 1);
        }
        $SEO = seo('我的信息');
        $this->load->librarys('View')->assign('user',$user);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('wechat-myMessage');
    }


    /*
     * 交易订单 weChat Menus
     * **/
    public function order(){
        $code = $_GET['code'];
        $user = $this->getOpenid($code);
        if(!$user){
            showmessage('', url('member/public/wechatlogin'), 1);
        }

        $SEO = seo('我的订单');
        $this->load->librarys('View')->assign('user',$user);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('wechat-order');
    }

    public function ajaxOrder(){
        $post = $_POST;
        $data['cardNo'] = $post['cardNo'];
        $data['arr'] = $post['arr'];
        $data['dep'] = $post['dep'];
        $order = $this->api->findResrvList($data);
        echo json_encode($order['resrvList']);
    }


    /*
     * 积分 weChat Menus
     * **/
    public function integral(){
        $code = $_GET['code'];
        $user = $this->getOpenid($code);
        if(!$user){
            showmessage('', url('member/public/wechatlogin'), 1);
        }

        $SEO = seo('我的积分');
        $this->load->librarys('View')->assign('user',$user);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('wechat-integral');
    }

    public function ajaxIntegral(){
        $post = $_POST;
        $sc['cardId'] = $post['cardId'];
        $sc['beginDate'] = $post['arr'];
        $sc['endDate'] = $post['dep'];
        $score = $this->api->getPointList($sc);
        echo json_encode($score['cardPointList']);
    }

    /*
     * 修改密码 weChat Menus
     * **/
    public function resetPwd(){
        $code = $_GET['code'];
        $user = $this->getOpenid($code);
        if(!$user){
            showmessage('', url('member/public/wechatlogin'), 1);
        }
        showmessage('', url('member/account/resetpassword'), 1);
    }


    /*
     * 用户信息返回
     * @code [String] code
     * @return [Array] 用户信息
     * **/
    public function getOpenid( $code ){
        $openidArr = $this->wechat->getOpenId($code);
        $map['openid'] = $openidArr['openid'];
        $user = $this->member_model->where($map)->find();
        $user['ly_msg'] = unserialize($user['ly_msg']);
        return $user;
    }





    /**
     * 商品快照
     * @param sku_id
     * @param order_sku_id 订单sku_id
     */
    public function snapshot()
    {
        $info = model('order/order_sku', 'service')->detail($_GET['order_sku_id']);
        $sales = model('goods/goods_index')->where(array('sku_id' => $_GET['sku_id']))->getField('sales');
        $goods = json_decode($info['sku_info'], true);
        $spec = json_decode($goods['sku_spec'], true);
        $img_list = json_decode($goods['img_list']);
        $SEO = seo('订单快照 - ' . $goods['sku_name']);
        $this->service->_history($_GET['sku_id']);
        $this->service->inc_hits($_GET['sku_id']);
        $this->load->librarys('View')->assign('info',$info);
        $this->load->librarys('View')->assign('sales',$sales);
        $this->load->librarys('View')->assign('goods',$goods);
        $this->load->librarys('View')->assign('spec',$spec);
        $this->load->librarys('View')->assign('img_list',$img_list);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('snapshot');
    }

    /**
     * [brand_list 品牌详情]
     * @return [type] [description]
     */
    public function brand_list()
    {
        $brand = $this->brand_service->get_brand_by_id($_GET['id']);
        if (!$brand) {
            showmessage($this->brand_service->error);
        }
        $SEO = seo($brand['name'], '', $brand['descript']);
        $result = $this->service->create_sqlmap($_GET);
        $this->load->librarys('View')->assign('brand',$brand);
        $this->load->librarys('View')->assign('result',$result);
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('brand_list');
    }

    /**
     * [category_lists wap分类列表]
     * @return [type] [description]
     */
    public function category_lists()
    {
        $SEO = seo('全部分类');
        $this->load->librarys('View')->assign('SEO',$SEO);
        $this->load->librarys('View')->display('classify');
    }

    /**
     * [ajax_like 猜你喜欢]
     * @return [type] [description]
     */
    public function ajax_goods()
    {
        $sqlmap = array();
        if ($_GET['order']) {
            $sqlmap['order'] = $_GET['order'] == 'rand' ? 'rand()' : ($_GET['order'] == 'sales' ? $sqlmap['order'] = 'sales desc' : $_GET['order']);
        } else {
            $sqlmap['order'] = 'sort asc,sku_id desc';
        }
        if ($_GET['statusext']) {
            $sqlmap['status_ext'] = $_GET['statusext'];
        }
        if ($_GET['catid'] > 0) {
            $sqlmap['catid'] = $_GET['catid'];
        }
        if ($_GET['limit']) {
            $options['limit'] = $_GET['limit'];
        } else {
            $options['limit'] = 5;
        }
        $result = $this->service->lists($sqlmap, $options);
        foreach ($result['lists'] as $key => $value) {
            $result['lists'][$key]['thumb'] = thumb($value['thumb'], $_GET['length'], $_GET['length']);
        }
        $this->load->librarys('View')->assign('result',$result);
        $result = $this->load->librarys('View')->get('result');
        echo json_encode($result);
    }

    /**
     * [html_load html加载完毕后执行]
     * @return [type] [description]
     */
    public function html_load()
    {
        runhook('html_load');
    }

    /** [get_lists wap获取商品列表]
     * @return [type] [description]
     */
    public function get_lists()
    {
        $sqlmap = $options = array();
        $sqlmap = $this->build_goods_map($_GET);
        $options['limit'] = $_GET['limit'] ? $_GET['limit'] : 5;
        $options['page'] = $_GET['page'] ? $_GET['page'] : 1;
        $result = $this->service->lists($sqlmap, $options);
        $this->load->librarys('View')->assign('result',$result);
        $result = $this->load->librarys('View')->get('result');
        echo json_encode($result);
    }

    /** [build_goods_map GET]
     * @return [type] [description]
     */
    private function build_goods_map($param)
    {
        $sqlmap = array();
        $sqlmap['catid'] = $param['id'];
        if ($param['map']['attr']) {
            $sqlmap['goods_ids'] = $this->service->goods_attr_screen($param['map']['attr']);
        }
        if ($param['keyword']) {
            $search = $this->service->search($param);
            unset($sqlmap['catid']);
            $sqlmap['goods_ids'] = $search['_goods_ids'];
        }
        if ($param['map']['price']) {
            $sqlmap['price'] = $param['map']['price'];
        }
        if ($param['map']['brand_id']) {
            $sqlmap['brand_id'] = $param['map']['brand_id'];
        }
        $sqlmap['order'] = $param['sort'] ? $param['sort'] : '';
        return $sqlmap;
    }

    /**
     * [get_consult 获取商品咨询]
     * @return [type] [description]
     */
    public function get_consult()
    {
        $sqlmap = array();
        $sqlmap['spu_id'] = $_GET['spu_id'];
        $options['limit'] = $_GET['limit'] ? $_GET['limit'] : 5;
        $options['page'] = $_GET['page'] ? $_GET['page'] : 1;
        $result = model('goods/goods_consult', 'service')->lists($sqlmap, $options);
        $this->load->librarys('View')->assign('result',$result);
        $result = $this->load->librarys('View')->get('result');
        echo json_encode($result);
    }

    /**
     * [ajax_limit ] 下拉分页 和 默认数据
     * @limit  exmaple: 0 , 8 ;
     */
    private function ajax_limit( $load , $page ){
        if( $load == '1' ){
            $prev = ( $page - 1 ) * 8 ;
            $now =  $page * 8;
            $limit = " {$prev} , {$now} ";
        }else{
            $limit = '0,8';
        }
        return $limit;
    }

    public function fulshm(){
        return $this->memcache->flushCache();
    }
}