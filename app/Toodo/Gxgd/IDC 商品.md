100011011　一次性消费服务商id
404550068715 一次性消费产品id

108749936 广电11楼机顶盒用户id


http://10.0.11.38/web-lezboss/service //! 正式环境
播放鉴权
http://10.1.15.38:9881/nn_cms/nn_cms_view/gxcatv20/n301_a.php?nns_func=check_play_auth&nns_user_id=108767767&nns_product_id=IDC_CP_TEST_MON&nns_video_id=&nns_cp_id=1000000004&nns_output_type=xml
http://10.1.15.38:9881/nn_cms/nn_cms_view/gxcatv20/n301_a.php?nns_func=check_play_auth&nns_user_id=108749936&nns_product_id=IDC_fbyx&nns_video_id=&nns_cp_id=1000000018&nns_output_type=xml

http://10.0.11.40/web-lezboss-test/service //! 测试环境
播放鉴权
请求地址是：http://10.0.15.33/nn_cms/nn_cms_view/gxcatv20/n301_a.php?nns_func=check_play_auth&nns_user_id=108767767&nns_product_id=IDC_CP_TEST_MON&nns_video_id=&nns_cp_id=1000000004&nns_output_type=xml
请求结果是：<?xml version="1.0" encoding="utf-8" ?><auth  state="0" reason="有权限" />

xml:   <?xml version="1.0" encoding="utf-8" ?><auth  state="1" reason="没有权限" is_support_preview="0" preview_time="" />
json:  {"state":1,"reason":"\u6ca1\u6709\u6743\u9650","is_support_preview":"0","preview_time":""}








<lezboss>
        <isSuccess>F</isSuccess>
        <request>
                <method>queryProdInfo</method>
                <stbId>34290024617</stbId>
                <productId>IDC_month|IDC_year|IDC_single|IDC_single_0.2</productId>
                <partner>1000000018</partner>
                <sign>9cc098ccac817331281b7b4e74c35a0b</sign>
        </request>
        <response>
                <retCode>FAIL</retCode>
                <prodInfos>
                </prodInfos>
        </response>
</lezboss>



促销信息
<lezboss>
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
                                </tariffs>
                        </prodDto>
                </prodInfos>
        </response>
</lezboss>

促销详情
<lezboss>
        <isSuccess>T</isSuccess>
        <request>
                <method>queryPromotionDetailsInfo</method>
                <produceId></produceId>
                <userId>108749857</userId>
                <promotionId>600048040</promotionId>
                <partner>1000000018</partner>
                <sign>cf28ccf1ca225785cbe89f1e88014800</sign>
        </request>
        <response>
                <retCode>SUCCESS</retCode>
                <prodInfos>
                        <PromotionDto>
                                <promotionId>600048040</promotionId>
                                <busiCode></busiCode>
                                <effDate></effDate>
                                <expDate>2018-12-31</expDate>
                                <pContent></pContent>
                                <pTitle>CP包月测试产品促销</pTitle>
                                <pType>2</pType>
                                <promotionCid></promotionCid>
                                <unit>P</unit>
                                <value>1.00</value>
                                <presentCircle></presentCircle>
                                <useCircle>0</useCircle>
                                <promotionPrice></promotionPrice>
                                <orderCircle></orderCircle>
                        </PromotionDto>
                </prodInfos>
        </response>
</lezboss>


BASE64方式解密
6I635Y+WU1DlpLHotKXvvJpObyB2YWx1ZSBwcmVzZW50
获取SP失败：No value present















<lezboss>
        <isSuccess>T</isSuccess>
        <request>
                <method>queryProdInfo</method>
                <stbId>34290157870</stbId>
                <productId>IDC_fbyx</productId>
                <partner>1000000018</partner>
                <sign>ace4f03d90c86a1c482528ff015e2332</sign>
        </request>
        <response>
                <retCode>SUCCESS</retCode>
                <prodInfos>
                        <prodDto>
                                <prodId>404550076954</prodId>
                                <prodName>飞奔游戏</prodName>
                                <prodType>73</prodType>
                                <status></status>
                                <orderDate></orderDate>
                                <tariffs>
                                                <tariffDto>
                                                        <tariffId>312073</tariffId>
                                                        <priceValue>29.00</priceValue>
                                                        <billingType>11</billingType>
                                                        <billingTypeName>包月(按日)</billingTypeName>
                                                </tariffDto>
                                                <tariffDto>
                                                        <tariffId>312072</tariffId>
                                                        <priceValue>16.00</priceValue>
                                                        <billingType>11</billingType>
                                                        <billingTypeName>包月(按日)</billingTypeName>
                                                </tariffDto>
                                </tariffs>
                        </prodDto>
                </prodInfos>
        </response>
</lezboss>
<lezboss>
        <isSuccess>T</isSuccess>
        <request>
                <method>queryPromotionInfo</method>
                <stbId>1140150003308</stbId>
                <productId>IDC_fbyx</productId>
                <partner>1000000018</partner>
                <sign>917543d1c14950afcb1e6667dbbab547</sign>
        </request>
        <response>
                <retCode>SUCCESS</retCode>
                <prodInfos>
                        <prodDto>
                                <prodId>404550076954</prodId>
                                <prodName>飞奔游戏</prodName>
                                <prodType>73</prodType>
                                <status></status>
                                <spId>600066333|600066332</spId>
                                <spName>飞奔游戏豪华专享半年包|飞奔游戏豪华专享季度包</spName>
                                <spRemark>飞奔游戏豪华专享半年包|飞奔游戏豪华专享季度包</spRemark>
                                <tariffs>
                                        <tariffDto>
                                                <tariffId>312073</tariffId>
                                                <priceValue>29.00</priceValue>
                                                <billingType>11</billingType>
                                                <billingTypeName>包月(按日)</billingTypeName>
                                        </tariffDto>
                                        <tariffDto>
                                                <tariffId>312072</tariffId>
                                                <priceValue>16.00</priceValue>
                                                <billingType>11</billingType>
                                                <billingTypeName>包月(按日)</billingTypeName>
                                        </tariffDto>
                                </tariffs>
                        </prodDto>
                </prodInfos>
        </response>
</lezboss>


<lezboss>
        <isSuccess>T</isSuccess>
        <request>
                <method>queryPromotionDetailsInfo</method>
                <produceId></produceId>
                <userId>108749857</userId>
                <promotionId>600066333</promotionId>
                <partner>1000000018</partner>
                <sign>9b5c930e065c80cb557c2601ac04f5b5</sign>
        </request>
        <response>
                <retCode>SUCCESS</retCode>
                <prodInfos>
                        <PromotionDto>
                                <promotionId>600066333</promotionId>
                                <busiCode></busiCode>
                                <effDate></effDate>
                                <expDate>2019-08-31</expDate>
                                <pContent></pContent>
                                <pTitle>飞奔游戏豪华专享半年包</pTitle>
                                <pType>2</pType>
                                <promotionCid></promotionCid>
                                <unit>P</unit>
                                <value>170.00</value>
                                <presentCircle></presentCircle>
                                <useCircle>0</useCircle>
                                <promotionPrice></promotionPrice>
                                <orderCircle></orderCircle>
                        </PromotionDto>
                </prodInfos>
        </response>
</lezboss>
<lezboss>
        <isSuccess>T</isSuccess>
        <request>
                <method>queryPromotionDetailsInfo</method>
                <produceId></produceId>
                <userId>108749857</userId>
                <promotionId>600066332</promotionId>
                <partner>1000000018</partner>
                <sign>ae6c9c8ca6af37418d7fe9231b5df766</sign>
        </request>
        <response>
                <retCode>SUCCESS</retCode>
                <prodInfos>
                        <PromotionDto>
                                <promotionId>600066332</promotionId>
                                <busiCode></busiCode>
                                <effDate></effDate>
                                <expDate>2019-08-31</expDate>
                                <pContent></pContent>
                                <pTitle>飞奔游戏豪华专享季度包</pTitle>
                                <pType>2</pType>
                                <promotionCid></promotionCid>
                                <unit>P</unit>
                                <value>99.00</value>
                                <presentCircle></presentCircle>
                                <useCircle>0</useCircle>
                                <promotionPrice></promotionPrice>
                                <orderCircle></orderCircle>
                        </PromotionDto>
                </prodInfos>
        </response>
</lezboss>

