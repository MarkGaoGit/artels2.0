<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php include template('toper','common');?>
<?php include template('header','common');?>
<?php include template('login','common');?>
<?php include template('logintoper','common');?>
<script>
    $('title').html('宝龙酒店集团');
</script>
<!--面包屑-->
<div class="container crumbs clearfix"></div>

<div class="margin-bottom item-blue-top content1200 about-top">
    <div class="item-title padding-left fff content1200 vip-top ">
        <a href="<?php echo __APP__;?>"><i class="icon-home"></i></a>
        <span class="web-add"><a href="<?php echo __APP__;?>">首页</a>&nbsp;&nbsp;＞&nbsp;&nbsp;<a href="<?php echo url('goods/index/about');?>">关于我们</a></span>
    </div>
    <div class='content hotel-logo content1200'>
        <img src="<?php echo __ROOT__ ?>template/default/statics/images/about.jpg" alt="">
    </div>
    <div class="about-nav text-big-small text-center text-white">
        <ul>
            <li data-types="1" class=" powerlong <?php if($_GET['part'] == 'powerlong' || empty($_GET['part'])) { ?> bg-main<?php } ?>">宝龙集团</li>
            <li data-types="2" class=" powerlonghotel <?php if($_GET['part'] == 'powerlonghotel' ) { ?> bg-main<?php } ?>">宝龙酒店集团</li>
            <li data-types="3" class=" pinpai <?php if($_GET['part'] == 'pinpai' ) { ?> bg-main<?php } ?>" style="margin-top:0;">酒店品牌</li>
            <li data-types="4" class=" hotelnews <?php if($_GET['part'] == 'hotelnews' ) { ?> bg-main<?php } ?>">新闻中心</li>
            <li data-types="5" class=" recruit <?php if($_GET['part'] == 'recruit' ) { ?> bg-main<?php } ?>">诚聘英才</li>
            <li data-types="6" class=" contact <?php if($_GET['part'] == 'contact' ) { ?> bg-main<?php } ?>">联系我们</li>
        </ul>
    </div>
    <div class="about-mask bg-main"></div>
</div>


<div class="jq-show text-big">
    <!--宝龙集团-->
    <div class="content-powerlong about-gg layout text-gray-666 <?php if($_GET['part'] == 'powerlong' || empty($_GET['part'])) { ?><?php } else { ?>hidden<?php } ?>">
        <p class="text-large margin-large-bottom ">宝龙与城市共成长</p>
        <p class="text-main strong">宝龙集团</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;宝龙集团于 1990 年在澳门成立。秉承“繁荣城市、创造价值”的企业 使命，宝龙产业经营不断拓展，形成地产、商业、酒店旅游、文化艺术、 工业&信息五大产业协同发展的格局。截至 2016 年底，集团总资产超过 1000 亿元人民币，有近万名员工活跃在海内外 200 多家公司。</p>
        <img class="fl margin-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/powerlong.jpg" alt="">
        <img class="fr margin-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/powerlong-city.jpg" alt="">
        <div class="clear"></div>
        <p class="text-main strong">宝龙地产(HK.1238)</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;由地产、商业、酒店旅游、文化艺术共同构成的宝龙地产控股体系 (HK.1238)，自 2003 年起专注开发运营综合性商业地产项目，2009 年在香 港主板成功上市，连续十一年获得“中国房地产百强企业”、连续六年获“中 国商业地产公司品牌价值 TOP10”等荣誉，旨在成为受人尊重、中国领先的 城市综合体运营商。</p>
        <a class="text-main text-default fr" target="_blank" href="http://www.powerlong.com">点击进入宝龙集团官网 ></a>
    </div>
    <!--宝龙酒店集团-->
    <div class="powerlong-hotel about-gg layout text-gray-666 <?php if($_GET['part'] != 'powerlonghotel') { ?>hidden<?php } ?>">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;酒店旅游业是宝龙集团五大产业之一，宝龙酒店集团于2015年正式成立，目前开始驶入快速发展轨道。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主营业务：国际品牌酒店、自创品牌连锁酒店、自创品牌连锁餐厅。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;宝龙酒店集团负责上述业务的管理及运营，在面对国内酒店旅游行业格局变化调整的市场大环境下，承担起新的历史使命，为宝龙集团在酒店旅游业开疆拓土，实施多元化经营战略夯实基础。</p>
        <img class="fl margin-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/aimei.jpg" alt="">
        <img class="fr margin-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/boerman.jpg" alt="">
        <div class="clear"></div>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;目前在全国范围内已有多家已开业的国际品牌五星酒店和自创品牌连锁酒店和自创品牌连锁餐厅。</p>
    </div>
    <!--酒店品牌 -->
    <div class="hotel-pinpai about-gg layout text-gray-666 <?php if($_GET['part'] != 'pinpai') { ?>hidden<?php } ?>">
        <p class="text-main strong">宝龙自创品牌连锁酒店</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;宝龙自创品牌连锁酒店是宝龙酒店集团旗下艺术主题酒店。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;“在酒店遇见艺术，让艺术融入生活”，是宝龙艺术酒店的发展愿景。2011年，宝龙集团开始涉足文化产业，成立了宝龙美术馆、宝龙艺术中心、书藏楼、宝龙华韵、韵致画廊和宝龙拍卖等文化艺术机构。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2015年，宝龙酒店集团正式成立，标志着宝龙以文化艺术为内核打造平台，以多年的城市综合体与酒店运营经验为支撑，形成艺术品、艺术衍生品和酒店业“文化”＋“商业”＋“艺术酒店”的艺术产业链的正式形成。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如今，宝龙酒店集团旗下自营品牌连锁酒店推出艺术酒店模式，全品牌线正式构建完成，以“艺筑、艺悦、艺悦精选、艺珺”覆盖从城市商务酒店、中档艺术主题酒店、高档艺术主题酒店、豪华艺术主题酒店。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;宝龙以文化艺术为内核打造平台，以对于才华的珍视与社会责任感汇聚文创英才，以多年的城市综合体与酒店运营经验为保障，形成艺术品、衍生品以及其他生活方式类服务与消费品的产业链与“文化”＋“商业”＋“艺术酒店”的复合经营业态，促进当地文化艺术休闲旅游市场的蓬勃繁荣。</p>
        <img class="  margin-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/about-jun.jpg" alt="">
        <img class="  margin-large-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/about-yiyuejia.jpg" alt="">
        <img class="  margin-large-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/about-yiyue.jpg" alt="">
        <img class="  margin-large-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/about-yizhu.jpg" alt="">
        <img class="  margin-large-top margin-bottom" src="<?php echo __ROOT__ ?>template/default/statics/images/about-kezhan.jpg" alt="">
    </div>
    <!--酒店新闻-->
    <div class="hotel-news about-gg layout text-gray-666 <?php if($_GET['part'] != 'hotelnews') { ?>hidden<?php } ?>">
        <ul>
            <?php
	$taglib_misc_article = new taglib('misc','article');
	$data = $taglib_misc_article->lists(array('category_id'=>'4','order'=>'sort ASC'), array('limit'=>'20','cache'=>'3683dd7a8a39fd81e98c4e418d7ad557,3600'));
?>
            <?php if(is_array($data)) foreach($data as $k => $r) { ?>            <a class="text-gray-666" href="<?php echo url('goods/index/article_detail',array('id'=>$r['id'],'types' => 'news'));?>" title="<?php echo $r['title'];?>">
                <li>
                    <p><?php echo $r['title'];?></p>
                    <?php echo date('Y-m-d', $r['dataline']);?>
                    <span class="fr jt text-big"> > </span>
                </li>
            </a>
            <?php } ?>
            
        </ul>
    </div>
    <!--诚聘英才-->
    <div class="hotel-recruit about-gg layout text-gray-666 <?php if($_GET['part'] != 'recruit') { ?>hidden<?php } ?>">
        <ul>
            <li>
                <p>如您对以下职位感兴趣，请发简历至宝龙酒店HR邮箱：hrhotel@powerlong.com</p>
            </li>
            <?php
	$taglib_misc_article = new taglib('misc','article');
	$data = $taglib_misc_article->lists(array('category_id'=>'5','order'=>'sort ASC'), array('limit'=>'20','cache'=>'9736d83d36a17b3591e8b37aba2eebc5,3600'));
?>
            <?php if(is_array($data)) foreach($data as $k => $r) { ?>            <a class="text-gray-666" href="<?php echo url('goods/index/article_detail',array('id'=>$r['id'],'types'=> 'recruit'));?>" title="<?php echo $r['title'];?>">
                <li>
                    <p><?php echo $r['title'];?></p>
                    <?php echo date('Y-m-d', $r['dataline']);?>
                    <span class="fr jt text-big"> > </span>
                </li>
            </a>
            <?php } ?>
            
        </ul>
    </div>
    <!--联系我们-->
    <div class="hotel-contact layout about-gg text-gray-666 <?php if($_GET['part'] != 'contact') { ?>hidden<?php } ?>">
        <p class="text-main" style="text-indent:33px;">宝龙酒店集团</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 联系电话：021-51759999</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 公司地址：上海市闵行区新镇路1399号宝龙大厦5楼</p>
    </div>
</div>

<input type="hidden" class="part" value="<?php echo $_GET['part'];?>">

<div class="clear"></div>

<?php include template('artels-footer','common');?>
<script>
    $('.logo').css({'opacity' : '1'});
    $('.footer-70').css({'top' : '0'});
    $('.artels-record').css({'top' : '0'});

    $('.about-nav li').on('click',function(){
        $(this).addClass('bg-main').siblings().removeClass('bg-main');
        var number = $(this).data('types'),
                _src = '';
        switch (number){
            case 1:
                _src = '<?php echo __ROOT__ ?>template/default/statics/images/about.jpg';
                $('.hotel-logo img').attr({ 'src' : _src});
                break;
            case 2:
                _src = '<?php echo __ROOT__ ?>template/default/statics/images/jituan.jpg';
                $('.hotel-logo img').attr({ 'src' : _src});
                break;
            case 3:
                _src = '<?php echo __ROOT__ ?>template/default/statics/images/hotelpinpai.jpg';
                $('.hotel-logo img').attr({ 'src' : _src});
                break;
        }
        $('.jq-show div:nth-child(' + number + ')').removeClass('hidden').addClass('show');
        $('.jq-show div').not($('.jq-show div:nth-child(' + number + ')')).removeClass('show').addClass('hidden');
    });

</script>