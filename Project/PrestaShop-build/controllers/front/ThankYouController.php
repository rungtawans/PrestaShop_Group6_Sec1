<?php

class CustomPageControllerCore extends FrontController
{
    public function initContent()
    {
        parent::initContent();

        // เรียกใช้งาน Template ที่ต้องการแสดงบนหน้า Custom Page
        $this->setTemplate('thankyou.tpl');
    }
}
