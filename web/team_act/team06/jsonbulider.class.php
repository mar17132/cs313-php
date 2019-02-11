<?php

function doubleQuoteWrap($wrapString)
{
    return "\"".$wrapString."\"";
}


class jsonBulider
{
    private $jsonString = "";
    private $jsonArray;


    public function getJsonArray()
    {
        return $this->jsonArray;
    }


    public function getJsonString()
    {
        return $this->jsonString;
    }


    public function addJsonObj()
    {
        array_push($this->jsonArray, new jsonObjBulider());
        return $this->jsonArray[count($this->jsonArray) - 1];
    }


    public function addJsonArray()
    {
        $newArray = new jsonArrayBulider();
        array_push($this->jsonArray, $newArray);
        var_dump($this->jsonArray);
        return $newArray;
    }


    public function addJsonData()
    {
        array_push($this->jsonArray, new jsonDataBulider());
        return $this->jsonArray[count($this->jsonArray) - 1];
    }


    //bulid json string
    public function bulidString()
    {
        $this->objString .= "{";

        foreach($this->jsonObjArrayValue as $key => $array)
        {
            $getClass = get_class($array);

            if($getClass == "jsonObjBulider")
            {
                $this->objString .= $array->bulidString();
            }
            elseif($getClass == "jsonArrayBulider")
            {
                $this->objString .= $array->bulidString();
            }
            elseif($getClass == "jsonDataBulider")
            {
                $this->objString .= $array->bulidString();
            }

            if($key < (count($this->jsonObjArrayValue) - 1))
            {
                $this->objString .= ",";
            }
        }

        $this->objString .= "}";

        return $this->objString;
    }


}


class jsonObjBulider
{
    private $jsonObjName;
    private $jsonObjArrayValue;
    private $inArray = false;
    private $objString;


    public function setJsonObjName($objName)
    {
        $this->jsonObjName = $objName;
    }


    public function getJsonObjName()
    {
        return $this->jsonObjName;
    }


    public function getJsonObjValue()
    {
        return $this->jsonObjValue;
    }


    public function setInArray($value)
    {
        $this->inArray = $value;
    }


    public function isInArray()
    {
        return $this->inArray;
    }


    //data that can be added
    public function addJsonObj($newValue)
    {
        array_push($this->jsonObjArrayValue,new jsonObjBulider());
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }


    public function addJsonObjArray()
    {
        array_push($this->jsonObjArrayValue,new jsonArrayBulider());
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }


    public function addJsonObjData()
    {
        array_push($this->jsonObjArrayValue,new jsonDataBulider());
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }



    //bulid obj string
    public function bulidString()
    {
        $this->objString .= "{";

        foreach($this->jsonObjArrayValue as $key => $array)
        {
            $getClass = get_class($array);

            if($getClass == "jsonObjBulider")
            {
                if(!isInArray())
                {
                    $this->objString .= doubleQuoteWrap($array->getJsonObjName());
                    $this->objString .= ":";
                }

                $this->objString .= $array->bulidString();
            }
            elseif($getClass == "jsonArrayBulider")
            {
                $this->objString .= $array->bulidString();
            }
            elseif($getClass == "jsonDataBulider")
            {
                $this->objString .= $array->bulidString();
            }

            if($key < (count($this->jsonObjArrayValue) - 1))
            {
                $this->objString .= ",";
            }
        }

        $this->objString .= "}";

        return $this->objString;
    }

}


class jsonArrayBulider
{
    private $jsonArrayName = "";
    private $jsonArrayValue;
    private $internalArray = false;
    private $objString = "";


    public function setJsonArrayName($name)
    {
        $this->jsonArrayName = $name;
    }


    public function getJsonArrayName()
    {
        return $this->jsonArrayName;
    }


    public function getJsonArrayValue()
    {
        $this->jsonArrayValue;
    }


    public function setInternalArray($inArray)
    {
        $this->internalArray = $inArray;
    }


    public function isInnerArray()
    {
        return $this->internalArray;
    }


    public function getObjString()
    {
        return $this->objString;
    }


    //data that can be added
    public function addArrayValue($newValue)
    {
        if(gettype($newValue) == "array")
        {
            array_merge($this->jsonArrayValue,$newValue);
        }
        else
        {
            array_push($this->jsonArrayValue,$newValue);
        }

    }


    public function addJsonObj()
    {
        array_push($this->jsonObjArrayValue,new jsonObjBulider());
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }


    public function addJsonObjArray()
    {
        array_push($this->jsonObjArrayValue,new jsonArrayBulider());
        $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1]->setInternalArray(true);
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }


    //bulid array string
    public function bulidString()
    {
        if(!$this->isInnerArray())
        {
            $this->objString .= doubleQuoteWrap($this->jsonArrayName).":";
        }

        $this->objString .= "[";

        foreach($this->jsonArrayValue as $key => $array)
        {
            if(gettype($array) != "object")
            {
                $this->objString .= is_string($this->jsonDataValue) ?
                                    doubleQuoteWrap($this->jsonDataValue) :
                                    $this->jsonDataValue;
            }
            else
            {
                $getClass = get_class($array);

                if($getClass == "jsonObjBulider")
                {
                    $this->objString .= $array->bulidString();
                }
                elseif($getClass == "jsonArrayBulider")
                {
                    $this->objString .= $array->bulidString();
                }
            }

            if($key < (count($this->jsonArrayValue) - 1))
            {
                $this->objString .= ",";
            }
        }

        $this->objString .= "]";

        return $this->objString;
    }

}


class jsonDataBulider
{
    private $jsonDataName;
    private $jsonDataValue;
    private $objString = "";

    public function setJsonDataName($name)
    {
        $this->jsonDataName = $name;
    }


    public function setJsonDataValue($value)
    {
        $this->jsonDataValue = $value;
    }


    public function getJsonDataName()
    {
        return $this->jsonDataName;
    }


    public function getJsonDataValue()
    {
        return $this->jsonDataValue;
    }


    public function getObjString()
    {
        return $this->objString;
    }


    //data string build
    public function buildString()
    {
        $this->objString .= doubleQuoteWrap($this->jsonDataName).":";
        $this->objString .= is_string($this->jsonDataValue) ?
                            doubleQuoteWrap($this->jsonDataValue) :
                            $this->jsonDataValue;
        return $this->objString;
    }

}

$jsonMainObj = new jsonBulider();
echo "test3";
$jsonTopicsArray = $jsonMainObj->addJsonArray();
echo "test4";
$jsonTopicsArray->setJsonArrayName("test");
echo "test4.5";
$topicObj = $jsonTopicsArray->addJsonObj();
echo "test5";
//book
$bookData = $topicObj->addJsonObjData();
$bookData->setJsonDataName("book");
$bookData->setJsonDataValue("mybook");
echo "test6";
//chapter
$chaperData = $topicObj->addJsonObjData();
$chaperData->setJsonDataName("chapter");
$chaperData->setJsonDataValue(5);

//verse
$verseData = $topicObj->addJsonObjData();
$verseData->setJsonDataName("verse");
$verseData->setJsonDataValue(25);

 //content
$contentData = $topicObj->addJsonObjData();
$contentData->setJsonDataName("content");
$contentData->setJsonDataValue("this is somintheing");


echo $jsonMainObj->bulidString();

echo "test";

?>
