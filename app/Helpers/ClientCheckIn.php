<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 4/14/17
 * Time: 2:06 PM
 */

namespace App\Common;


class ClientCheckIn
{
    public static function getClientDetails()
    {
        return '
          <script>
        function explode(){
            $(\'.alert\').fadeOut();
        }
        setTimeout(explode, 4000);
//        </script>
        <div class="col-lg-10 col-md-10 col-sm-10">
            <div class="alert alert-error'.''.'ui-pnotify" aria-live="assertive" aria-role="alertdialog" id="notify" style="position: fixed; z-index: 1; top: 20px; right: 20px; cursor: auto;">
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
                    <h3 class="ui-pnotify-title">'. '' .'</h3>
                    <div class="ui-pnotify-text" aria-role="alert"> 
                        ' .'TESTING'.' 
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
             width:100%;
            }
        }
        </style>';
    }
}