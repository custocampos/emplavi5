<?php
function baseUrl()
{
    return "https://emplavi.bitrix24.com.br/rest/24/9e633sjmyd22pb2p/";
}
function doRequest($queryUrl, $queryData)
{

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $queryUrl,
        CURLOPT_POSTFIELDS => $queryData,
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    if ($result) {
        return $result;
    }

}


   
function criaArray()
{

    $queryUrl = baseUrl() . '/crm.contact.list.json';
    $queryData = http_build_query(array(
        "select"=> array( "ID", "NAME", "LAST_NAME","EMAIL", "PHONE")
    ));

    return doRequest($queryUrl, $queryData);

}

function procuraStringID($string,$ids,$nomes){
    $posicao=array_search($string, $nomes, true);
    $idF=$ids[$posicao];
    return $idF;
}


function getContact($id)
{

    $queryUrl = baseUrl() . '/crm.contact.get.json';
    $queryData = http_build_query(array(
        "ID" => $id,
    ));
    return doRequest($queryUrl, $queryData);

}

function getUser($id)
{

    $queryUrl = baseUrl() . '/user.get.json';
    $queryData = http_build_query(array(
        "ID" => $id,
    ));
    return doRequest($queryUrl, $queryData);

}

function listContact($cont)
{
    $queryUrl = baseUrl() . '/crm.contact.list.json';
    $queryData =http_build_query(array(
        'filter' => array( '>ID' => $cont),
        "select"=> array( "ID", "NAME", "LAST_NAME","EMAIL", "PHONE")
       ));

return doRequest($queryUrl, $queryData);
}

function listDepart()
{
    $queryUrl = baseUrl() . '/department.get.json';
    $queryData =http_build_query(array(
        'PARENT' => 5
       ));

return doRequest($queryUrl, $queryData);
}

function listUserDepart($id)
{
    $queryUrl = baseUrl() . '/user.get.json';
    $queryData =http_build_query(array(
        'filter' => array( 'UF_DEPARTMENT' => $id)
       ));

return doRequest($queryUrl, $queryData);
}

function createContact($data)
{
    $queryUrl = baseUrl() . '/crm.contact.add.json';
    $queryData = http_build_query(array(
        'fields' => array(
            'NAME' => $data["nome"],
            "LAST_NAME" => $data["sobrenome"],
            "EMAIL" => array(
                array(
                    "VALUE" => $data["email"],
                    "VALUE_TYPE" => "WORK",
                )),
                "PHONE" => array(
                    array(
                        "VALUE" => $data["tel"],
                        "VALUE_TYPE" => "WORK",
                    ),
                    array(
                        "VALUE" => $data["tel2"],
                        "VALUE_TYPE" => "WORK",
                    )
                ),
            
        ),
    ));
    return doRequest($queryUrl, $queryData);

}

function updateContact($data)
{
    $queryUrl = baseUrl() . '/crm.contact.update.json';
    $queryData = http_build_query(array(
        'ID' => $data["id"],
        'fields' => array(
            'NAME' => $data["nome"],
            'LAST_NAME'=> $data["sobrenome"],
            "EMAIL" => array(
                array(
                    "VALUE" => $data["email"],
                    "VALUE_TYPE" => "WORK",
                )),
                "PHONE" => array(
                    array(
                        "VALUE" => $data["tel1"],
                        "VALUE_TYPE" => "WORK",
                    ),
                    array(
                        "VALUE" => $data["tel2"],
                        "VALUE_TYPE" => "WORK",
                    )
                )
        ),
    ));
    return doRequest($queryUrl, $queryData);

}

function getDeal($id,$emp)
    {

        $queryUrl = baseUrl() . '/crm.deal.list.json';
        $queryData = http_build_query(array(
            'filter' => array("CONTACT_ID" => $id, "CATEGORY_ID" => 0,"UF_CRM_1604688211"=> $emp),
        ));
        return doRequest($queryUrl, $queryData);

    }



    function getDeal2($id,$emp)
    {

        $queryUrl = baseUrl() . '/crm.deal.list.json';
        $queryData = http_build_query(array(
            'filter' => array("CONTACT_ID" => $id, "CATEGORY_ID" => 16,"UF_CRM_1604688211"=> $emp),
        ));
        return doRequest($queryUrl, $queryData);

    }


    function updateDeal($idDeal,$idCor)
    {
        $queryUrl = baseUrl() . '/crm.deal.update.json';
        $queryData = http_build_query(array(
            'ID' => $idDeal,
            'fields' => array(
                "UF_CRM_1608035727" => $idCor,
                ),
        ));

    return doRequest($queryUrl, $queryData);
}



    function getFields($field)
    {

        $queryUrl = baseUrl() . '/crm.deal.userfield.list.json';
        $queryData = http_build_query(array(
            'filter' => array("FIELD_NAME" => $field),
        ));
        return doRequest($queryUrl, $queryData);

    }

    function createDeal($nome,$contato,$emp)
    {
        $queryUrl = baseUrl() . '/crm.deal.add.json';
        $queryData = http_build_query(array(
            'fields' => array(
                'TITLE' => $nome,
                "TYPE_ID"=> "SALE",
                "CATEGORY_ID" => "18",
                'CONTACT_ID' => $contato,
                "UF_CRM_1604688211"=> $emp
            ),
        ));
        return doRequest($queryUrl, $queryData);

    }

    function createDeal2($nome,$contato,$emp)
    {
        $queryUrl = baseUrl() . '/crm.deal.add.json';
        $queryData = http_build_query(array(
            'fields' => array(
                'TITLE' => $nome,
                "TYPE_ID"=> "SALE",
                "CATEGORY_ID" => "18",
                'CONTACT_ID' => $contato,
                "SOURCE_ID" => "10",
                "UF_CRM_1604688211"=> $emp
            ),
        ));
        return doRequest($queryUrl, $queryData);

    }

    function getElement($id)
    {

        $queryUrl = baseUrl() . '/lists.element.get.json';
        $queryData = http_build_query(array(
            'IBLOCK_TYPE_ID' => 'bitrix_processes',
            'IBLOCK_ID' => '36',
            'filter' => array("PROPERTY_142"=>$id)
        ));
        return doRequest($queryUrl, $queryData);

    }

    function createElement($data)
    {
        $date = date("d-m-Y H:i:s");

        $queryUrl = baseUrl() . '/lists.element.add.json';
        $queryData = http_build_query(array(
            'IBLOCK_TYPE_ID' => 'bitrix_processes',
            'IBLOCK_ID' => '36',
            'ELEMENT_ID'=>$data["id"],
            'FIELDS' => array(
                'NAME' => '.',
                "PROPERTY_288"=> $date,
                "PROPERTY_142"=>$data["idDeal"],
                'PROPERTY_154' => $data["coment"],
                'PROPERTY_276' => $data["gerente"],
                'PROPERTY_284' => $data["cor1"],
                'PROPERTY_286' => $data["cor2"],
                'PROPERTY_278' => $data["fonte"],
                'PROPERTY_280' => $data["tipo"],
                'PROPERTY_304'=> $data["rec"]
            ),
        ));
        return doRequest($queryUrl, $queryData);

    }

    function workStart($id)
    {
        $queryUrl = baseUrl() . '/bizproc.workflow.start.json';
        $queryData = http_build_query(array(
            "TEMPLATE_ID" => "138",
            "DOCUMENT_ID" => array("bp_list", "BizprocDocument",$id),
        ));
        return doRequest($queryUrl, $queryData);

    }