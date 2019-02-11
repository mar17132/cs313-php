<?php

function doubleQuoteWrap($wrapString)
{
    return "\"".$wrapString."\"";
}


class jsonBulider
{
    private $jsonString = "";
    private $jsonArray;


    public getJsonArray()
    {
        return $this->jsonArray;
    }


    public getJsonString()
    {
        return $this->jsonString;
    }


    public addJsonObj()
    {
        array_push($this->jsonArray, new jsonObjBulider());
        return $this->jsonArray[cout($this->jsonArray) - 1];
    }


    public addJsonArray()
    {
        array_push($this->jsonArray, new jsonArrayBulider());
        return $this->jsonArray[cout($this->jsonArray) - 1];
    }


    public addJsonData()
    {
        array_push($this->jsonArray, new jsonDataBulider());
        return $this->jsonArray[cout($this->jsonArray) - 1];
    }


    //bulid json string
    public bulidString()
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


    public setJsonObjName($objName)
    {
        $this->jsonObjName = $objName;
    }


    public getJsonObjName()
    {
        return $this->jsonObjName;
    }


    public getJsonObjValue()
    {
        return $this->jsonObjValue;
    }


    public setInArray($value)
    {
        $this->inArray = $value;
    }


    public isInArray()
    {
        return $this->inArray;
    }


    //data that can be added
    public addJsonObj($newValue)
    {
        array_push($this->jsonObjArrayValue,new jsonObjBulider());
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }


    public addJsonObjArray()
    {
        array_push($this->jsonObjArrayValue,new jsonArrayBulider());
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }


    public addJsonObjData()
    {
        array_push($this->jsonObjArrayValue,new jsonDataBulider());
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }



    //bulid obj string
    public bulidString()
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
    private $jsonArrayName;
    private $jsonArrayValue;
    private $internalArray = false;
    private $objString = "";


    public setJsonArrayName($name)
    {
        $this->jsonArrayName = $name;
    }


    public getJsonArrayName()
    {
        return $this->jsonArrayName;
    }


    public getJsonArrayValue()
    {
        $this->jsonArrayValue;
    }


    public setInternalArray($inArray)
    {
        $this->internalArray = $inArray;
    }


    public isInnerArray()
    {
        return $this->internalArray;
    }


    public getObjString()
    {
        return $this->objString;
    }


    //data that can be added
    public addArrayValue($newValue)
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


    public addJsonObj()
    {
        array_push($this->jsonObjArrayValue,new jsonObjBulider());
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }


    public addJsonObjArray()
    {
        array_push($this->jsonObjArrayValue,new jsonArrayBulider());
        $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1]->setInternalArray(true);
        return $this->jsonObjArrayValue[count($this->jsonObjArrayValue) - 1];
    }


    //bulid array string
    public bulidString()
    {
        if(!$this->isInnerArray())
        {
            $this-objString .= doubleQuoteWrap($this->jsonArrayName).":";
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

    public setJsonDataName($name)
    {
        $this->jsonDataName = $name;
    }


    public setJsonDataValue($value)
    {
        $this->jsonDataValue = $value;
    }


    public getJsonDataName()
    {
        return $this->jsonDataName;
    }


    public getJsonDataValue()
    {
        return $this->jsonDataValue;
    }


    public getObjString()
    {
        return $this->objString;
    }


    //data string build
    public buildString()
    {
        $this->objString .= doubleQuoteWrap($this->jsonDataName).":";
        $this->objString .= is_string($this->jsonDataValue) ?
                            doubleQuoteWrap($this->jsonDataValue) :
                            $this->jsonDataValue;
        return $this->objString;
    }

}

$jsonMainObj = new jsonBulider();

$jsonTopicsArray = $jsonMainObj->addJsonArray();

$jsonTopicsArray->setJsonObjName("test");
$topicObj = $jsonTopicsArray->addJsonObj();

//book
$bookData = $topicObj->addJsonObjData();
$bookData->setJsonDataName("book");
$bookData->setJsonDataValue("mybook");

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

?>
