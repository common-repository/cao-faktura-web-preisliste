<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: CAO Faktura Web Preisliste
Description: CAO Faktura Web Preisliste über Shortcodes integrieren
Author: comsigno.de Andreas Oehme Aha EDV Support AG Markus Winter
Author URI: https://www.comsigno.de
Version: 1.1.17
*/




class Comsigno_NaturalStonePricelist {
    private $natural_stone_pricelist_options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'natural_stone_pricelist_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'natural_stone_pricelist_page_init' ) );
    }

    public function natural_stone_pricelist_add_plugin_page() {
        add_menu_page(
            'CAO Faktura Web Preisliste', // page_title
            'CAO Faktura Web Preisliste', // menu_title
            'manage_options', // capability
            'natural-stone-pricelist', // menu_slug
            array( $this, 'natural_stone_pricelist_create_admin_page' ), // function
            'dashicons-info', // icon_url
            76 // position
        );
    }

    public function natural_stone_pricelist_create_admin_page() {
        $this->natural_stone_pricelist_options = get_option( 'natural_stone_pricelist_option_name' ); ?>

		<div class="wrap">
			<h2>CAO Faktura Web Preisliste</h2>
			<p></p>
            <?php settings_errors(); ?>

			<form method="post" action="options.php">
                <?php
                settings_fields( 'natural_stone_pricelist_option_group' );
                do_settings_sections( 'natural-stone-pricelist-admin' );
                submit_button();
                ?>
			</form>
		</div>
    <?php }

    public function natural_stone_pricelist_page_init() {
        register_setting(
            'natural_stone_pricelist_option_group', // option_group
            'natural_stone_pricelist_option_name', // option_name
            array( $this, 'natural_stone_pricelist_sanitize' ) // sanitize_callback
        );

        add_settings_section(
            'natural_stone_pricelist_setting_section', // id
            'Settings', // title
            array( $this, 'natural_stone_pricelist_section_info' ), // callback
            'natural-stone-pricelist-admin' // page
        );

        add_settings_field(
            'connectiontype_0', // id
            'Connectiontype', // title
            array( $this, 'connectiontype_0_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );

        add_settings_field(
            'mysql_server_1', // id
            'mysql-server ', // title
            array( $this, 'mysql_server_1_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );

        add_settings_field(
            'mysql_user_2', // id
            'mysql-user', // title
            array( $this, 'mysql_user_2_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );

        add_settings_field(
            'mysql_pw_3', // id
            'mysql-pw', // title
            array( $this, 'mysql_pw_3_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );

        add_settings_field(
            'mysql_db_4', // id
            'mysql-db', // title
            array( $this, 'mysql_db_4_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );

        add_settings_field(
            'path_csv1_5', // id
            'Path CSV1', // title
            array( $this, 'path_csv1_5_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );

        add_settings_field(
            'path_csv2_6', // id
            'Path CSV2', // title
            array( $this, 'path_csv2_6_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );

        add_settings_field(
            'footertext_7', // id
            'Footertext NaSto', // title
            array( $this, 'footertext_7_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );

        add_settings_field(
            'footertext_8', // id
            'Footertext Local', // title
            array( $this, 'footertext_8_callback' ), // callback
            'natural-stone-pricelist-admin', // page
            'natural_stone_pricelist_setting_section' // section
        );
    }

    public function natural_stone_pricelist_sanitize($input) {
        $sanitary_values = array();
        if ( isset( $input['connectiontype_0'] ) ) {
            $sanitary_values['connectiontype_0'] = $input['connectiontype_0'];
        }

        if ( isset( $input['mysql_server_1'] ) ) {
            $sanitary_values['mysql_server_1'] = sanitize_text_field( $input['mysql_server_1'] );
        }

        if ( isset( $input['mysql_user_2'] ) ) {
            $sanitary_values['mysql_user_2'] = sanitize_text_field( $input['mysql_user_2'] );
        }

        if ( isset( $input['mysql_pw_3'] ) ) {
            $sanitary_values['mysql_pw_3'] = sanitize_text_field( $input['mysql_pw_3'] );
        }

        if ( isset( $input['mysql_db_4'] ) ) {
            $sanitary_values['mysql_db_4'] = sanitize_text_field( $input['mysql_db_4'] );
        }

        if ( isset( $input['path_csv1_5'] ) ) {
            $sanitary_values['path_csv1_5'] = sanitize_text_field( $input['path_csv1_5'] );
        }

        if ( isset( $input['path_csv2_6'] ) ) {
            $sanitary_values['path_csv2_6'] = sanitize_text_field( $input['path_csv2_6'] );
        }

        if ( isset( $input['footertext_7'] ) ) {
            $sanitary_values['footertext_7'] = ( str_replace("\"","'", $input['footertext_7'] ));
        }

        if ( isset( $input['footertext_8'] ) ) {
            $sanitary_values['footertext_8'] = ( str_replace("\"","'", $input['footertext_8'] ));
        }
        return $sanitary_values;
    }

    public function natural_stone_pricelist_section_info() {

    }

    public function connectiontype_0_callback() {
        ?> <fieldset><?php $checked = ( isset( $this->natural_stone_pricelist_options['connectiontype_0'] ) && $this->natural_stone_pricelist_options['connectiontype_0'] === 'internal' ) ? 'checked' : '' ; ?>
			<label for="connectiontype_0-0"><input type="radio" name="natural_stone_pricelist_option_name[connectiontype_0]" id="connectiontype_0-0" value="internal" <?php echo $checked; ?>> interne mySQL-Verbindung</label>
            <?php $checked = ( isset( $this->natural_stone_pricelist_options['connectiontype_0'] ) && $this->natural_stone_pricelist_options['connectiontype_0'] === 'csv' ) ? 'checked' : '' ; ?>
			<label for="connectiontype_0-1"><input type="radio" name="natural_stone_pricelist_option_name[connectiontype_0]" id="connectiontype_0-1" value="csv" <?php echo $checked; ?>> CSV Dateien</label><br>
            <?php $checked = ( isset( $this->natural_stone_pricelist_options['connectiontype_0'] ) && $this->natural_stone_pricelist_options['connectiontype_0'] === 'mysql' ) ? 'checked' : '' ; ?>
			<label for="connectiontype_0-2"><input type="radio" name="natural_stone_pricelist_option_name[connectiontype_0]" id="connectiontype_0-2" value="mysql" <?php echo $checked; ?>> mySQL-Verbindung</label></fieldset> <?php
    }

    public function mysql_server_1_callback() {
        printf(
            '<input class="regular-text" type="text" name="natural_stone_pricelist_option_name[mysql_server_1]" id="mysql_server_1" value="%s">',
            isset( $this->natural_stone_pricelist_options['mysql_server_1'] ) ? esc_attr( $this->natural_stone_pricelist_options['mysql_server_1']) : ''
        );
    }

    public function mysql_user_2_callback() {
        printf(
            '<input class="regular-text" type="text" name="natural_stone_pricelist_option_name[mysql_user_2]" id="mysql_user_2" value="%s">',
            isset( $this->natural_stone_pricelist_options['mysql_user_2'] ) ? esc_attr( $this->natural_stone_pricelist_options['mysql_user_2']) : ''
        );
    }

    public function mysql_pw_3_callback() {
        printf(
            '<input class="regular-text" type="password" name="natural_stone_pricelist_option_name[mysql_pw_3]" id="mysql_pw_3" value="%s">',
            isset( $this->natural_stone_pricelist_options['mysql_pw_3'] ) ? esc_attr( $this->natural_stone_pricelist_options['mysql_pw_3']) : ''
        );
    }

    public function mysql_db_4_callback() {
        printf(
            '<input class="regular-text" type="text" name="natural_stone_pricelist_option_name[mysql_db_4]" id="mysql_db_4" value="%s">',
            isset( $this->natural_stone_pricelist_options['mysql_db_4'] ) ? esc_attr( $this->natural_stone_pricelist_options['mysql_db_4']) : ''
        );
    }

    public function path_csv1_5_callback() {
        printf(
            '<input class="regular-text" type="text" name="natural_stone_pricelist_option_name[path_csv1_5]" id="path_csv1_5" value="%s">',
            isset( $this->natural_stone_pricelist_options['path_csv1_5'] ) ? esc_attr( $this->natural_stone_pricelist_options['path_csv1_5']) : ''
        );
    }

    public function path_csv2_6_callback() {
        printf(
            '<input class="regular-text" type="text" name="natural_stone_pricelist_option_name[path_csv2_6]" id="path_csv2_6" value="%s">',
            isset( $this->natural_stone_pricelist_options['path_csv2_6'] ) ? esc_attr( $this->natural_stone_pricelist_options['path_csv2_6']) : ''
        );
    }

    public function footertext_7_callback() {
        printf(
            '<textarea class="regular-text" rows=5 name="natural_stone_pricelist_option_name[footertext_7]" id="footertext_7">%s</textarea>',
            isset( $this->natural_stone_pricelist_options['footertext_7'] ) ? ( $this->natural_stone_pricelist_options['footertext_7']) : ''
        );
    }

    public function footertext_8_callback() {
        printf(
            '<textarea class="regular-text" rows=5 name="natural_stone_pricelist_option_name[footertext_8]" id="footertext_8">%s</textarea>',
            isset( $this->natural_stone_pricelist_options['footertext_8'] ) ? ( $this->natural_stone_pricelist_options['footertext_8']) : ''
        );
    }
}
if ( is_admin() )
    $natural_stone_pricelist = new Comsigno_NaturalStonePricelist();


add_action('wp_enqueue_scripts', 'Comsigno_initcss');
function Comsigno_initcss() {
    wp_register_style( 'comsigno_naturalstone', plugins_url( 'coms_ns.css', __FILE__ ));
    wp_enqueue_style( 'comsigno_naturalstone' );

}


//include "coms_con.php";

function Comsigno_getConnection() {

    $natural_stone_pricelist_options = get_option( 'natural_stone_pricelist_option_name' );

    $conntype="internal";
    if ( isset( $natural_stone_pricelist_options['connectiontype_0'] )) $conntype = $natural_stone_pricelist_options['connectiontype_0'];
    if ($conntype=="internal") {

        $request = wp_remote_get( 'https://preise.naturalstone.ch/coms_con.php' );
        $conb64 = wp_remote_retrieve_body( $request );
        $con1=base64_decode($conb64);
        $con=explode('|',$con1);
        if ($con[0]!='') {
            $conn = mysqli_connect($con[0], $con[1], $con[2], $con[3]);
        }
        else
        {
            $conn=null;
        }
    }
    if ($conntype=="mysql") {
        $srv= $natural_stone_pricelist_options['mysql_server_1'];
        $usr= $natural_stone_pricelist_options['mysql_user_2'];
        $paw= $natural_stone_pricelist_options['mysql_pw_3'];
        $dba= $natural_stone_pricelist_options['mysql_db_4'];

        $conn = mysqli_connect($srv,$usr,$paw,$dba);
    }
    return $conn;
}


function Comsigno_getArticlesbyCat($catid, $conn)  {


    if ($conn) {
        mysqli_query($conn,"set names utf8");
        $sql="select artikel.ARTNUM,artikel.KURZNAME,artikel.LANGNAME,artikel.VK5, mengeneinheit.Bezeichnung as einheit from artikel left join mengeneinheit on mengeneinheit.REC_ID = artikel.ME_ID where artikel.SHOP_VISIBLE=1 and artikel.REC_ID in (select ARTIKEL_ID from artikel_to_kat where KAT_ID=$catid) order by artikel.artnum asc";
		$trs="";
        if ($result = mysqli_query($conn, $sql))
            while ($row = mysqli_fetch_object($result)) {
                $price=number_format($row->VK5,2,',','.');
                $articledesc=nl2br($row->LANGNAME);

                $trs.="
<div class='comsigno_zeilencontainer' kat='$catid'>
	<div class='comsigno_artno'><p>$row->ARTNUM</p></div>
	<div class='comsigno_descr'><p>
	<span class='comsigno_tglbtn' id='1tgl$row->ARTNUM' onclick=\"toggle_visibility('$row->ARTNUM');\"></span>
    <span class='comsigno_tglbtn2' id='2tgl$row->ARTNUM' onclick=\"toggle_visibility('$row->ARTNUM');\"></span>
	<span class='comsigno_articlehead'>$row->KURZNAME</span>
    <span class='comsigno_articledesc' id='$row->ARTNUM'>$articledesc</span></p></div>
	<div class='comsigno_einheit'><p>$row->einheit</p></div>
	<div class='comsigno_price'><p>$price</p></div>
</div>
";

            }

    } else {die('Could not connect: ' . mysql_error());}


    $head="<div class='comsigno_zeilencontainer comsigno_nomobile comsigno_header'>
	<div class='heAno'>Art.Nr.</div>
	<div class='heBez'>Bezeichnung</div>
	<div class='heEin'>ME</div>
	<div class='hePre'>Preis</div>
</div>";

    if ($trs!="") {
        return $head.$trs;
    } else {
        return "";
    }

}


function Comsigno_getCategoryDetails($catid, $conn) {

    $cat = null;
    if ($conn) {
        mysqli_query($conn,"set names utf8");
        $sql = "select NAME, BESCHREIBUNG, KURZTEXT from artikel_kat where ID=$catid";
        if ($result = mysqli_query($conn, $sql))
            while ($row = mysqli_fetch_object($result)) {
                $cat = $row;
            }

    } else {
        die();
    }

    return $cat;

}

function Comsigno_getSubCategories($catid, $conn)
{
    $cats = array();
    if ($conn) {
        mysqli_query($conn,"set names utf8");
        $sql = "select distinct * from artikel_kat where TOP_ID=$catid)";
        $sql_rec="select  ID,
        NAME, KURZTEXT,
        TOP_ID
from    (select * from artikel_kat
         order by NAME,TOP_ID, ID) artikel_kat,
        (select @pv := '$catid') initialisation
where   find_in_set(TOP_ID, @pv) > 0
and     @pv := concat(@pv, ',', ID) order by NAME";
        if ($result = mysqli_query($conn, $sql_rec))
            while ($row = mysqli_fetch_object($result)) {
                $cats[$row->ID] = $row;
                $cat2=Comsigno_getSubCategories2($row->ID, $conn);
                foreach ($cat2 as $c2) $cats[$c2->ID] = $c2;
            }

    }
    else {
        die();
    }

    return $cats;
}



function Comsigno_getSubCategories2($catid, $conn)
{
    $cats = array();
    if ($conn) {
        mysqli_query($conn,"set names utf8");
        $sql = "select * from artikel_kat where TOP_ID=$catid)";
        $sql_rec="select  ID,
        NAME, KURZTEXT,
        TOP_ID
from    (select * from artikel_kat
         order by NAME,TOP_ID, ID) artikel_kat,
        (select @pv := '$catid') initialisation
where   find_in_set(TOP_ID, @pv) > 0
and     @pv := concat(@pv, ',', ID) order by NAME";
        if ($result = mysqli_query($conn, $sql_rec))
            while ($row = mysqli_fetch_object($result)) {
                $cats[] = $row;
            }

    }
    else {
        die();
    }

    return $cats;
}

function Comsigno_createPricelist ($atts) {
    $conn=Comsigno_getConnection();


    $natural_stone_pricelist_options = get_option( 'natural_stone_pricelist_option_name' ); // Array of All Options
    $footertext=$natural_stone_pricelist_options['footertext_7'];

    $category=$atts['kat'];

    if ($category=="")  $category=$atts['category'];

    if ($category==0) {
        $cats=Comsigno_ListCategories($conn);

        $out="<table><colgroup><col style='width:10%'><col style='width:10%'><col style='width:50%'><col style='width:30%'></colgroup><thead><tr><th>ID</th><th>Mutter ID</th><th>Kategorie</th><th>Shortcode</th></tr></thead><tbody>";
        foreach ($cats as $cat) {
            $out.="<tr><td>$cat->ID</td><td>$cat->TOP_ID</td><td>$cat->NAME</td><td>[manpl kat=$cat->ID]</td></tr>";
        }
        $out.="</tbody></table>";

        return $out;

    } else {

        $subcategories = Comsigno_getSubCategories($category, $conn);

        $erg = "";
        $pricelist = Comsigno_getArticlesbyCat($category, $conn);
        $catdetails = Comsigno_getCategoryDetails($category, $conn);

        if (is_null($catdetails)) {
            $erg .= "<div class='comsigno_cs_box'>
                <h2><a id='nskat_$category'>Zu Kategorie $category gibt es aktuell keine Artikel</a></h2>
                </div>";

        } else
            if ($pricelist != "") {
                $erg .= "
                <h2><a id='nskat_$category'>$catdetails->NAME</a></h2>
                <p>$catdetails->BESCHREIBUNG</p>
            $pricelist";
            } else {
                $erg .= "
                <h2><a id='nskat_$category'>$catdetails->NAME</a></h2>
                <p>$catdetails->BESCHREIBUNG</p>
            ";
            }

        foreach ($subcategories as $sub) {
            $pricelist = Comsigno_getArticlesbyCat($sub->ID, $conn);
            $catdetails = Comsigno_getCategoryDetails($sub->ID, $conn);
            if ($pricelist != "") {
                $erg .= "
                <h2>$catdetails->NAME</h2>
                <p>$catdetails->BESCHREIBUNG</p>
            $pricelist
            
           
            ";
            }
        }

        $erg.="<div class='comsigno_footerzeile'>$footertext</div>";

        $css = "<style>
            .comsigno_articletable {width:100%}
            .comsigno_articletable td {vertical-align: top}
            .comsigno_articlehead {font-weight:600;width:100%;display:block;vertical-align: top;}            
            .comsigno_articledesc {font-weight:300;width:100%;display:none;vertical-align: top;}
            .comsigno_tglbtn {float:right;margin-left:5px;background-image: url('" . plugins_url('expand.png', __FILE__) . "'); height: 20px;   width: 26px; background-size: contain;display: block}
            .comsigno_tglbtn2 {float:right;margin-left:5px;background-image: url('" . plugins_url('collapse.png', __FILE__) . "'); height: 20px;   width: 26px; background-size: contain;display: none}
            
            
            
        </style>
        <script>
        function toggle_visibility(id) {
            var e = document.getElementById(id);
            var b1= document.getElementById('1tgl'+id);
            var b2= document.getElementById('2tgl'+id);
                if(e.style.display == 'block') {
                    e.style.display = 'none';
                    b1.style.display = 'block';
                    b2.style.display = 'none';
                } else {
                    e.style.display = 'block';
                    b1.style.display = 'none';
                    b2.style.display = 'block';
                }
              return;
        }
</script>
        ";

        @mysqli_close($conn);
        return $css . "<div class='comsigno_cs_box'>" . $erg . "</div>";
    }
    @mysqli_close($conn);
}

function Comsigno_createPricelist_local ($atts) {

    $natural_stone_pricelist_options = get_option( 'natural_stone_pricelist_option_name' ); // Array of All Options
    $footertext=$natural_stone_pricelist_options['footertext_8'];

    $srv= $natural_stone_pricelist_options['mysql_server_1'];
    $usr= $natural_stone_pricelist_options['mysql_user_2'];
    $paw= $natural_stone_pricelist_options['mysql_pw_3'];
    $dba= $natural_stone_pricelist_options['mysql_db_4'];

    $conn = mysqli_connect($srv,$usr,$paw,$dba) or die();


    $category=$atts['kat'];

    if ($category=="")  $category=$atts['category'];

    if ($category==0) {
        $cats=Comsigno_ListCategories($conn);

        $out="<table><colgroup><col style='width:10%'><col style='width:10%'><col style='width:50%'><col style='width:30%'></colgroup><thead><tr><th>ID</th><th>Mutter ID</th><th>Kategorie</th><th>Shortcode</th></tr></thead><tbody>";
        foreach ($cats as $cat) {
            $out.="<tr><td>$cat->ID</td><td>$cat->TOP_ID</td><td>$cat->NAME</td><td>[manpl kat=$cat->ID]</td></tr>";
        }
        $out.="</tbody></table>";

        return $out;

    } else {

        $subcategories = Comsigno_getSubCategories($category, $conn);

        $erg = "";
        $pricelist = Comsigno_getArticlesbyCat($category, $conn);
        $catdetails = Comsigno_getCategoryDetails($category, $conn);

        if (is_null($catdetails)) {
            $erg .= "<div class='comsigno_cs_box'>
                <h2><a id='nskat_$category'>Zu Kategorie $category gibt es aktuell keine Artikel</a></h2>
                </div>";

        } else
            if ($pricelist != "") {
                $erg .= "
                <h2><a id='nskat_$category'>$catdetails->NAME</a></h2>
                <p>$catdetails->BESCHREIBUNG</p>
            $pricelist";
            } else {
                $erg .= "
                <h2><a id='nskat_$category'>$catdetails->NAME</a></h2>
                <p>$catdetails->BESCHREIBUNG</p>
            ";
            }
        foreach ($subcategories as $sub) {

            $pricelist = Comsigno_getArticlesbyCat($sub->ID, $conn);
            $catdetails = Comsigno_getCategoryDetails($sub->ID, $conn);
            if ($pricelist != "") {
                $erg .= "
                <h2>$catdetails->NAME</h2>
                <p>$catdetails->BESCHREIBUNG</p>
            $pricelist
            
          
            ";
            }
        }
        $erg.="  <div class='comsigno_footerzeile'>$footertext</div>";

        $css = "<style>
            .comsigno_articletable {width:100%}
            .comsigno_articletable td {vertical-align: top}
            .comsigno_articlehead {font-weight:600;width:100%;display:block;vertical-align: top;}            
            .comsigno_articledesc {font-weight:300;width:100%;display:none;vertical-align: top;}
            .comsigno_tglbtn {float:right;margin-left:5px;background-image: url('" . plugins_url('expand.png', __FILE__) . "'); height: 20px;   width: 26px; background-size: contain;display: block}
            .comsigno_tglbtn2 {float:right;margin-left:5px;background-image: url('" . plugins_url('collapse.png', __FILE__) . "'); height: 20px;   width: 26px; background-size: contain;display: none}
            
            
            
        </style>
        <script>
        function toggle_visibility(id) {
            var e = document.getElementById(id);
            var b1= document.getElementById('1tgl'+id);
            var b2= document.getElementById('2tgl'+id);
                if(e.style.display == 'block') {
                    e.style.display = 'none';
                    b1.style.display = 'block';
                    b2.style.display = 'none';
                } else {
                    e.style.display = 'block';
                    b1.style.display = 'none';
                    b2.style.display = 'block';
                }
              return;
        }
</script>
        ";
        @mysqli_close($conn);
        return $css . "<div class='comsigno_cs_box'>" . $erg . "</div>";
    }
    @mysqli_close($conn);
}

function Comsigno_ListCategories($conn)
{
    $cat = array();
    if ($conn) {
        mysqli_query($conn, "set names utf8");
        $sql = "select ID,NAME, TOP_ID from artikel_kat order by NAME";
        if ($result = mysqli_query($conn, $sql))
            while ($row = mysqli_fetch_object($result)) {
                $cat[] = $row;
            }

    } else {
        die();
    }
    return $cat;
}


function Comsigno_createCatlist ($atts) {

    $conn=Comsigno_getConnection();

    $natural_stone_pricelist_options = get_option( 'natural_stone_pricelist_option_name' );
    $mysql_server_1 = $natural_stone_pricelist_options['mysql_server_1']; // mysql-server ...

    $erg="";
    $subcategories=Comsigno_getSubCategories(-1,$conn);
    foreach ($subcategories as $sub) {
		$countsubs=0;
		foreach ($subcategories as $sub2) if ($sub2->TOP_ID==$sub->ID) $countsubs++;
        if ($sub->TOP_ID==-1 && $countsubs>0) {

            $erg .= "<div class='comsigno_stoneitem'>
                <h2><a href='#nskat_$sub->ID'>$sub->NAME</a></h2>
                <p>$sub->KURZTEXT</p>
            </div>";
        }
    }


    $css="<style>
            
            .comsigno_articletable td {vertical-align: top}
            .comsigno_articlehead {font-weight:600;width:100%;display:block;vertical-align: top;}            
            .comsigno_articledesc {font-weight:300;width:100%;display:none;vertical-align: top;}
            .comsigno_tglbtn {float:right;margin-left:5px;background-image: url('".plugins_url( 'expand.png', __FILE__ )."'); height: 20px;   width: 26px; background-size: contain;display: block}
            .comsigno_tglbtn2 {float:right;margin-left:5px;background-image: url('".plugins_url( 'collapse.png', __FILE__ )."'); height: 20px;   width: 26px; background-size: contain;display: none}
            
            
            
        </style>
        
        ";
    return $css."<div class='comsigno_stonecontainer'>$erg</div>";

}


add_shortcode('nspl', 'Comsigno_createPricelist');
add_shortcode('manpl', 'Comsigno_createPricelist_local');
add_shortcode('naturalStonePricelist', 'Comsigno_createPricelist');
add_shortcode('naturalStoneCategories', 'Comsigno_createCatlist');


?>