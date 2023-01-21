<?php

class View_Loader
{
    private $data = array();
    private $render = FALSE;
    private $selectedItems = FALSE;
    private $style = FALSE;


    public function __construct($viewName)
        /**
     * A __construct függvény lehetővé teszi az objektum tulajdonságainak 
     * inicializálását az objektum létrehozásakor. 
     * Ha létrehozunk egy __construct () függvényt, a PHP automatikusan meghívja ezt a függvényt, 
     * amikor objektumot hozunk létre egy osztályból.
     */
    {
        $file = SERVER_ROOT . 'views/' . strtolower($viewName) . '.php';
        if (file_exists($file))
        /**
         * A file_exists () függvény a PHP-ben egy beépített függvény, 
         * amely annak ellenőrzésére szolgál, hogy létezik-e fájl vagy könyvtár vagy sem. 
         * Az ellenőrizni kívánt fájl vagy könyvtár elérési útja paraméterként kerül átadásra a 
         * file_exists () függvénynek, amely siker esetén igaz logikai értéket, 
         * kudarc esetén false értéket ad vissza.
         */
        {
            $this->render = $file;
            $this->selectedItems = explode("_", $viewName);
        }        
        $file = SERVER_ROOT . 'css/' . strtolower($viewName) . '.css';
        //A strtolower() függvény a karakterláncot kisbetűssé alakítja.
        if (file_exists($file))
        {
            //A betöltött oldal css tulajdonságait adja hozzá
            $this->style = SITE_ROOT . 'css/' . strtolower($viewName) . '.css';;
        }        
    }
    // értékek hozzárendelése
    public function assign($variable , $value)
    {
        $this->data[$variable] = $value;
    }

    public function __destruct() //A destruktor metódus meghívásra kerül, 
    //amint nincs más hivatkozás egy adott objektumra, 
    //vagy bármilyen sorrendben a leállítási folyamat során.
    {
        $this->data['render'] = $this->render;
        $this->data['selectedItems'] = $this->selectedItems;
        $this->data['style'] = $this->style;
        $viewData = $this->data; // Az oldal betöltésekor a megjelenítendő adatot rendeli hozzá
        include(SERVER_ROOT . 'views/page_main.php');
    }
}

?>