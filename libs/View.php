<?php
class View
{
    function __construct(){}    

    public function getView($vista,$data = null) {
        $config = Config::singleton();
        $path = $config->get('viewsFolder') . $vista;
        $html = $this->getTemplate($path,$data);
        print $html;
        return;
    }
 
    public function getTemplate($form='get',$data=[]) {
        ob_start();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (count($data)>0) {
            foreach ($data as $key => $value) {
                $_SESSION[$key] = $value;
            }   
        }
        include($form);
        $template = ob_get_contents();
        ob_end_clean();
        return $template;
    }

}
?>