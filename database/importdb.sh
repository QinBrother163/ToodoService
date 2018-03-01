#!/bin/sh

#mysql -Dtoodo_service -uroot -ptoodo1814 < users.sql;

mysql -Dtoodo_service -uroot -ptoodo1814 < edo_game_infos.sql;
mysql -Dtoodo_service -uroot -ptoodo1814 < edo_item_infos.sql;
mysql -Dtoodo_service -uroot -ptoodo1814 < edo_shop_infos.sql;
mysql -Dtoodo_service -uroot -ptoodo1814 < edo_area_infos.sql;

mysql -Dtoodo_service -uroot -ptoodo1814 < tda_songs.sql;
mysql -Dtoodo_service -uroot -ptoodo1814 < tdo_goods_infos.sql;

#mysql -Dtoodo_service -uroot -ptoodo1814 < tdo_gxgd_assets.sql;
#mysql -Dtoodo_service -uroot -ptoodo1814 < tdo_gxgd_prods.sql;

