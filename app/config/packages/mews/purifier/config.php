<?php

/*
 * This file is part of HTMLPurifier Bundle.
 * (c) 2012 Maxime Dizerens
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(

	'encoding' => 'UTF-8',
    'finalize' => true,
    'preload'  => false,
    'settings' => array(
        'default' => array(
            'HTML.Allowed'             => 'iframe[src|width|height|frameborder],h1,h2,h3,h4,h5,pre,del,br,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
            'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => false,
            'HTML.SafeIframe'          => true,
            'Attr.AllowedFrameTargets' => '_blank, _self, _target, _parent',
            'Attr.EnableID'            => true,
            'AutoFormat.Linkify'       => true,
            'URI.SafeIframeRegexp'     => '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
            'AutoFormat.RemoveEmpty'   => true
        ),
    ),
);
