<?php
//printf("%02d %02d", 7, 28);
//
//echo "\n";
//$s = sprintf("%02d %02d", 7, 28);
//echo $s;


$str =
    '<lezboss>
        <isSuccess>T</isSuccess>
        <request>
                <method>queryPromotionInfo</method>
                <stbId>1140150003308</stbId>
                <productId>IDC_CP_TEST_MON|IDC_CP_TEST_YEAR|IDC_CP_TEST_DP</productId>
                <partner>1000000018</partner>
                <sign>622b59415064175821f0fabea5dd21f5</sign>
        </request>
        <response>
                <retCode>SUCCESS</retCode>
                <prodInfos>
                        <prodDto>
                                <prodId>404550068570</prodId>
                                <prodName>CP包月测试产品包</prodName>
                                <prodType>73</prodType>
                                <status>正常</status>
                                <spId>600048040</spId>
                                <spName>CP包月测试产品促销</spName>
                                <spRemark>CP包月测试产品促销</spRemark>
                                <tariffs>
                                        <tariffDto>
                                                <tariffId>291493</tariffId>
                                                <priceValue>.10</priceValue>
                                                <billingType>11</billingType>
                                                <billingTypeName>包月(按日)</billingTypeName>
                                        </tariffDto>
                                        <tariffDto>
                                                <tariffId>291493</tariffId>
                                                <priceValue>.10</priceValue>
                                                <billingType>11</billingType>
                                                <billingTypeName>包月(按日)</billingTypeName>
                                        </tariffDto>
                                </tariffs>
                        </prodDto>
                        <prodDto>
                                <prodId>404550068570</prodId>
                                <prodName>CP包月测试产品包</prodName>
                                <prodType>73</prodType>
                                <status>正常</status>
                                <spId>600048040</spId>
                                <spName>CP包月测试产品促销</spName>
                                <spRemark>CP包月测试产品促销</spRemark>
                                <tariffs>
                                        <tariffDto>
                                                <tariffId>291493</tariffId>
                                                <priceValue>.10</priceValue>
                                                <billingType>11</billingType>
                                                <billingTypeName>包月(按日)</billingTypeName>
                                        </tariffDto>
                                </tariffs>
                        </prodDto>
                </prodInfos>
        </response>
</lezboss>';

$xml = simplexml_load_string($str);
$json = json_decode(json_encode($xml));
echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";