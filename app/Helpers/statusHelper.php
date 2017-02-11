<?php

namespace App\StatusHelper;

/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 2/9/17
 * Time: 7:50 PM
 */
class statusHelper
{

    public static function format_message($type,$message)
    {
        $type == 'success' ? $title = 'Success' : $title = 'Error';
        return '
          <script>
        function explode(){
            $(\'.alert\').fadeOut();
        }
        setTimeout(explode, 4000);
//        </script>
        <div class="col-lg-10 col-md-10 col-sm-10">
            <div class="alert alert-'.$type.' ui-pnotify" aria-live="assertive" aria-role="alertdialog" id="notify" style="position: fixed; z-index: 1; top: 20px; right: 20px; cursor: auto;">
                <div class="alert ui-pnotify-container ui-pnotify-shadow" role="alert" style="min-height: 16px;">
                    <div class="ui-pnotify-closer" aria-role="button" tabindex="0" title="Close" style="cursor: pointer; visibility: hidden; display: none;">
                        <span class="glyphicon glyphicon-remove"></span>
                    </div>
                    <div class="ui-pnotify-sticker" aria-role="button" aria-pressed="true" tabindex="0" title="Unstick" style="cursor: pointer; visibility: hidden; display: none;">
                        <span class="glyphicon glyphicon-play" aria-pressed="true"></span>
                    </div>
                    <div class="ui-pnotify-icon">
                        <span class="glyphicon glyphicon-info-sign"></span>
                    </div>
                    <h3 class="ui-pnotify-title">'. $title .'</h3>
                    <div class="ui-pnotify-text" aria-role="alert"> 
                        '. $message .' 
                    </div>
                </div>
            </div>
        </div>
        <style>
        #notify{
            width:40%;
        }
        @media screen and (max-width: 550px) {
        #notify {
             width:80%;
            }
        }
        </style>
        
        ';
    }
}