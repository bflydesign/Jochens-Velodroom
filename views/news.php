<!-- FULL -->
<div class="col-lg-7 content">
    <h1 id="pagename"><?php print isset($title) ? $title : ''; ?></h1>

    <div class="row newsitems">
        <div class="col-lg-12">
            <?php foreach($news as $item) { ?>
            <article>
                <div class="row">
                    <div class="col-lg-8">
                        <span id="news-title-<?php print $item->getId(); ?>"><?php print $item->getTitle(); ?></span>
                    </div>
                    <div class="col-lg-4 text-right">
                        <span id="news-date-<?php print $item->getId(); ?>"><?php print $item->getDateCreated()->format('d-m-Y'); ?></span>
                        <span id="news-time-<?php print $item->getId(); ?>">@<?php print $item->getDateCreated()->format('H:i'); ?></span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <p id="news-message-<?php print $item->getId(); ?>"><?php print $item->getContent(); ?></p>
                </div>
                <div class="col-lg-6">
                    <div class="fb-like" data-href="https://www.facebook.com/jochensvelodroom" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
                </div>
                <div class="col-lg-6">
                    <ul class="soc">
                        <li><a class="soc-facebook" href="#"></a></li>
                        <li><a class="soc-google" href="https://plus.google.com/share?url={URL}"
                               onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
                        </li>
                        <li><a class="soc-twitter" href="https://twitter.com/share" target="_blank"></a></li>
                        <li><a class="soc-pinterest"
                               href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'></a>
                        </li>
                        <li><a class="soc-email2 soc-icon-last"
                               href="mailto:?subject=Jochens Velodroom&body=http://www.jochensvelodroom.be"></a></li>
                    </ul>
                </div>
                <hr/>
            </article>
            <?php } ?>
        </div>
    </div>
</div>