<?php

namespace Iplan\Services\Html;

use Collective\Html\HtmlBuilder as BaseBuilder;

class HtmlBuilder extends BaseBuilder
{
    /**
     * Open Email Content Block.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function openEmailContentBlock()
    {
        return $this->toHtmlString('
            <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
        ');
    }
    
    /**
     * Close Email Content Block.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function closeEmailContentBlock()
    {
        return $this->toHtmlString('
            </td>
            </tr>
        ');
    }
    
    /**
     * Return Email Action Link Button.
     *
     * @param string $text
     * @param string $link
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function emailActionLink($text = '', $link = '')
    {
        return $this->toHtmlString('
            <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <td class="content-block" itemprop="handler" itemscope
                    itemtype="http://schema.org/HttpActionHandler"
                    style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                    valign="top">
                    <a href="' . $link . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">
                        ' . $text . '
                    </a>
                </td>
            </tr>
        ');
    }
}
