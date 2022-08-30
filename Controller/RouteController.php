<?php
class RouteController {
    public function __construct($server){
        // pour passer des parametres à une class je doit impérativement utiliser
        // une fonction __construct($param1,$param2,etc...)
        $this->server = $server;
       
    }
    private $server;
    // remplacez si besoin les $workDir, $viewDir et $controlDir 
    private $workDir = "/POO/netflix";//nom de vos dossiers dans /wamp64/www
    private $viewDir = "/View/";
    private $controlDir = "/Controller/";
    private $modeleDir = "/Modele/";
    private $repositoryDir = "/repository/";
    private $incDir = "/inc/";
    private $ext = ".php";

    public function getRoute($route){
        if($route === "index"){
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/view"));
            return $path.$this->workDir;
        } else {
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/view"));
            return $path.$this->workDir.$this->viewDir.$route.$this->ext;
        }
    }

    public function getController($route){
        if(strpos($this->server["REQUEST_URI"], "index")){
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/index.php"));
        } else {
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/view"));
        }
        $root = $this->server["CONTEXT_DOCUMENT_ROOT"] . $path;
        return $root.$this->workDir.$this->controlDir.$route.$this->ext;
    }
    public function getModele($route){
        if(strpos($this->server["REQUEST_URI"], "index")){
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/index.php"));
        } else {
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/modele"));
        }
        $root = $this->server["CONTEXT_DOCUMENT_ROOT"] . $path;
        return $root.$this->workDir.$this->modeleDir.$route.$this->ext;
    }
    public function getRepository($route){
        if(strpos($this->server["REQUEST_URI"], "index")){
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/index.php"));
        } else {
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/repository"));
        }
        $root = $this->server["CONTEXT_DOCUMENT_ROOT"] . $path;
        return $root.$this->workDir.$this->repositoryDir.$route.$this->ext;
    }
    public function getInc($route){
        if(strpos($this->server["REQUEST_URI"], "index")){
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/index.php"));
        } else {
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/inc"));
        }
        $root = $this->server["CONTEXT_DOCUMENT_ROOT"] . $path;
        return $root.$this->workDir.$this->incDir.$route.$this->ext;
    }

}