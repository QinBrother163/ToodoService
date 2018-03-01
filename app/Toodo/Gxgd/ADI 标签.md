# 二维码生成
curl -d "client_id=e587a147-85eb-4831-95e0-3c8c946fa782&client_secret=b3681756-184e-475e-bfe6-cf81f3042ee&grant_type=client_credentials" http://10.1.41.135/index/client/token


# 请求播放串
curl "http://10.0.11.51/gxcatv20/AuthIndexStandard?nns_func=check_auth_and_get_media_by_media&nns_user_id=&nns_version=1.0.0.GXGD.0.0TEST&nns_video_id=&nns_cp_video_id=test2017070101001101001700000000&nns_video_type=0&nns_cp_id=test&nns_tag=26&nns_cdn_flag=rtsp_vod"
curl "http://10.0.11.51/gxcatv20/AuthIndexStandard?nns_func=check_auth_and_get_media_by_media&nns_user_id=108767767&nns_version=1.0.0.GXGD.0.0TEST&nns_video_id=&nns_cp_video_id=fbkj2017072601001101001100000000&nns_video_type=0&nns_cp_id=fbkj&nns_tag=26&nns_cdn_flag=rtsp_vod"

'userId' => '108767767',
用adi的title assetID查询
test2017070101001101000100000000   ok
test2017070101001101001600000000
test2017070101001101001700000000
test2017070101001102001800000000
fbkj2017072601001101001100000000
fbkj2017072601001101001800000000


# 查询媒体资源状态
curl -d "func=select_asset&import_id=test2017070101001101001700000000&select_type=check,online,lock&cp_id=test" http://10.0.11.51/nn_cms/nn_cms_manager/service/asset_import/k23/asset_api.php
curl -d "func=select_asset&import_id=fbkj2017072601001101001100000000&select_type=check,online,lock&cp_id=FBKJ" http://10.0.11.51/nn_cms/nn_cms_manager/service/asset_import/k23/asset_api.php
# 媒体资源操作
先下线，再删除
curl -d "func=unline_assets&assets_id=test2017070101001101001700000000&assets_unline=0&cp_id=test" http://10.0.11.51/nn_cms/nn_cms_manager/service/asset_import/k23/asset_api.php
<result  ret="0" code=""  reason="操作完成" id="" debug="OK"></result>

curl -d "func=unline_assets&assets_id=test2017070101001101001700000000&assets_unline=0&cp_id=test" http://10.0.11.51/nn_cms/nn_cms_manager/service/asset_import/k23/asset_api.php
<result  ret="1" code="10000114"  reason="媒资对应的资源库栏目关联的媒资包栏目为空" id="" debug="OK"></result>

curl -d "func=unline_assets&assets_id=test2017070101001101001700000000&assets_unline=0&cp_id=test" http://10.0.11.51/nn_cms/nn_cms_manager/service/asset_import/k23/asset_api.php
<result  ret="0" code=""  reason="媒资自动上线完成" id="" debug="OK"></result>


#* assetId 32位
[4位]fbyx + [6位]项目编号 + [6位]资源编号 + [16位]md5补全
fbyx010011 020001xxxxxxxxxxxxxxxx

#* poster
Ui_Style
Title
Summary

#* movie
Bit_Rate
Content_FileSize
Run_Time
FileFormat
CodeFormat
Format
HD_Format
SD_Format
Strean_Size
Asset_Tag
Asset_Profile

#* title
Title
Title_Sec
Title_Brief
AssetType
Run_Time
Show_Type
Genre
Keyword
Season
TotalNumber
Chapter
Summary_Long
Summary_Long_Sec
Language
Subtitle_Language
Director
Director_Sec
Actors
Actors_Sec
Writers
Writers_Sec
Provider
Provider_Sec
Play_Date
Premiere_Date
Year
Country_Of_Origin
Country_Of_Origin_Sec
Column
Audience
Classify
Licensing_Window_Start
Licensing_Window_End
Rate
Suggested_Price
HighLight
Awards
Screen_Writer

#* package
Metadata_Spec_Version
Classify
Genre
Keyword
Year
Actors
Director
Summary_Long
Country_Of_Origin
Language
Licensing_Window_Start
Licensing_Window_End
TotalNumber
VodResourceType