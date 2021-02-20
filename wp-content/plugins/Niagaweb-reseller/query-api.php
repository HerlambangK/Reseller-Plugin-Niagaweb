<?php
/*
Plugin Name: Niagaweb plugin reseller
Plugin URI:https://omukiguys.com
Description:Plugin For Reseller from Niagaweb
Version:0.1
Author:Bembie
AUthor URI:https://gooogle.com
licence:GPL-3.0+
licence URI:http:www.gnu.org/licencses/gpl-2.0.txt
*/



// function shapeSpace_include_custom_jquery()
// {

//     wp_deregister_script('jquery');
//     wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true);
// }
// add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

defined('ABSPATH') or die('Unauthorized Access!');
/**
 * Register a custom menu page.
 */
function wpdocs_register_produk_reseller_menu_page()
{
    add_menu_page(
        __('Reseller product', 'textdomain'),
        'Reseller product',
        'manage_options',
        'java-product.php',
        'get_product_reseller',
        // plugins_url( 'myplugin/images/icon.png' ),
        'dashicons-store',
        6
    );
    add_submenu_page(

        'edit.php?post_type=book',
        __('Books Shortcode Reference', 'textdomain'),
        __('Shortcode Reference', 'textdomain'),
        'manage_options',
        'books-shortcode-ref',
        'books_ref_page_callback'

    );
}
add_action('admin_menu', 'wpdocs_register_produk_reseller_menu_page');
function create_menu_page()
{
}


// add_action('subadmin_menu', 'wpdocs_register_produk_javatraveller_submenu_page');
// function create_submenu_page()
// {
// }

// add_action('admin_init', 'callback_function_name');


function get_product_Reseller()
{
    $args = array(
        'headers' => array(
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        )
    );
    $request = wp_remote_get('http://app.javatraveller.com/api/product?category_id=4', $args);
    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body);


    if (200 == wp_remote_retrieve_response_code($request)) {
        $file_link = WP_PLUGIN_DIR . '/Niagaweb-reseller/data-reseller-product.json';
        echo '<pre>';
        // var_dump($data);
        echo '</pre>';
        $message = $body;
        write_to_file($message, $file_link);
    }

    if (is_wp_error($request)) {
        $file_link = WP_PLUGIN_DIR . '/Niagaweb-reseller/error-log.txt';
        $error_message = $request->get_error_message();
        echo "<pre>";
        echo 'Something went wrong:' . $error_message;
        $error_message = $request->get_error_message();
        $message = date('d m Y g:i:a') . ' ' . wp_remote_retrieve_response_code($request) . ' ' . $error_message;
        write_to_file($message, $file_link);
        echo "</pre>";
    }
    table_product($data);
}

function write_to_file($message, $file_link)
{
    if (file_exists($file_link)) {
        $filing = fopen($file_link, 'a');
        fwrite($filing, $message . "\n");
    } else {
        $filing = fopen($file_link, 'w');
        fwrite($filing, $message . "\n");
    }
    fclose($filing);
}

function table_product($data)
{
    $args = array(
        'headers' => array(
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        )
    );
    $request = wp_remote_get('http://app.javatraveller.com/api/product?category_id=4', $args);
    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body);


?>
<style>
table,
td,
th {
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    padding: 15px;
}
</style>
</style>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://code.jquery.com/jquery-3.5.1.min.js" rel="stylesheet" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <title>Document</title>
</head>

<body>
    <section id="reseller">
        <div class="container">
            <h1 class="text-center"> Perhitungan Perkiraan Harga Reseller </h1>
            <h5 class="text-center">Simulasi Potensi Penghasilan </h5>
            <div class="text-muted text-center">
                <p>created by bembie</p>
            </div>

            <form action="#" method="post" @submit.prevent="getReseller()">
                <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                    <label for="name">Masukan Nama Anda</label>
                    <input type="text" class="form-control" id="name" aria-describedby="name"
                        placeholder="masukan nama anda disini" v-model="nama">
                    <small id="name" class="form-text text-muted">Masukan nama anda sebagai reseller.</small>
                </div>
                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="form-group">
                        <label>Status</label>
                        <p class="text-muted">
                            Apakah Tinggkat Satus anda sekarang ?
                        </p>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="status-sekarang" id="statusTrue"
                                value=0.15 v-model="tingkat" />
                            <label for="statusTrue" class="custom-control-label">Reseller</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="status-sekarang" id="stausFalse"
                                value=0.5 v-model="tingkat" />
                            <label for="stausFalse" class="custom-control-label">Agen</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                    <label for="product">Jumlah Product Terjual</label>
                    <input type="number" class="form-control" id="product" aria-describedby="product"
                        placeholder="masukan jumlah produk disini" v-model="jumlahProduk">
                    <small id="product" class="form-text text-muted">Masukan masukan jumlah produk terjual dalam
                        satu
                        bulan.</small>
                </div>
                <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                    <label for="hargaproduk">Harga Rata rata produk</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type=" number" class="form-control" id="hargaproduk" aria-describedby="hargaproduk"
                            placeholder=" masukan harga rata rata anda disini" v-model="hargaProduk">

                    </div>
                    <small id="hargaproduk" class="form-text text-muted">harga yang dimasukan hanya harga rata
                        rata
                        dari
                        kesuruhan
                        produk yang anda jual</small>
                </div>
                <div class="form-group" data-aos="fade-up" data-aos-delay="500">
                    <label>Potensi penghasilan</label>
                    <h4>Rp{{potensi}}</h4>
                </div>

                <button type="sumbit" class="btn btn-primary" data-aos="fade-up" data-aos-delay="400"
                    @click="getReseller()" data-bs-toggle="modal" data-bs-target="#resellerModal">Submit</button>
            </form>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="resellerModal" tabindex="-1" aria-labelledby="resellerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resellerModalLabel">Hasil Anda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="container mt-5">
                            <table border="1">
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ nama }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah produk</td>
                                    <td>{{ jumlahProduk }}</td>
                                </tr>
                                <tr>
                                    <td>Tingkat Status</td>
                                    <td> {{ tingkat }}
                                </tr>
                                <tr>
                                    <td>Harga Produk</td>
                                    <td>Rp {{ hargaProduk }}</td>
                                </tr>
                                <tr>
                                    <td>Potensi Penghasilan</td>
                                    <td>Rp {{ potensi }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>


    </section>





    <!-- Bootstrap core JavaScript -->
    <!-- <script src=" /vendor/jquery/jquery.slim.min.js">
                        </script>
                        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script>
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
    </script>
    <script>
    AOS.init();
    </script>
    <script>
    var reseller = new Vue({
        el: '#reseller',
        mounted() {
            AOS.init();
        },

        data: {
            nama: '',
            jumlahProduk: '',
            tingkat: '',
            hargaProduk: '0',
            potensi: '0'
        },

        methods: {
            getReseller() {
                return this.potensi = this.jumlahProduk * (this.hargaProduk * this.tingkat /
                    100);
            }
        },
    });
    </script>
</body>

</html>

<?php


  }