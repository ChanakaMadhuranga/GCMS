<?php

    include("./inc/connection.php");

    $sql= "SELECT * FROM user INNER JOIN update_bin ON user.u_nic_no = update_bin.u_nic_no ";
    $result=$connection->query( $sql );

    $attribs=array('id','u_nic_no','u_first_name','u_last_name','u_latitude','u_longitude', 'plastic_not_sell', 'plastic_sell', 'organic_not_sell', 'organic_sell', 'polythene_not_sell','polythene_sell', 'metal_not_sell', 'metal_sell', 'paper_not_sell', 'paper_sell', 'coconut_shell_not_sell', 'coconut_shell_sell', 'glass_not_sell', 'glass_sell', 'fabric_not_sell', 'fabric_sell', 'e_waste_not_sell', 'e_waste_sell');


    $dom=new DOMDocument('1.0','utf-8');
    $dom->formatOutput=true;
    $dom->standalone=true;
    $dom->recover=true;

    $root=$dom->createElement('tbl_master_property');
    $dom->appendChild( $root );


    while( $rs=$result->fetch_object() ){
        $node=$dom->createElement('marker');
        $root->appendChild( $node );

        foreach( $attribs as $attrib ){
            $attr = $dom->createAttribute( $attrib );
            $value= $dom->createTextNode( $rs->$attrib );
            $attr->appendChild( $value );
            $node->appendChild( $attr );
        }
    }

    header("Content-Type: application/xml");
    echo $dom->saveXML();

?>