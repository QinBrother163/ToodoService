const retail = {
    gxgd: '96335',
    hnyx: '96266',
    gdgd: '96956',
    none: '1000'
};

function getRetailId() {
    try {//广西广电
        if (guangxi && iPanel) {
            return retail.gxgd;
        }
    } catch (e) {
    }
    try {//河南有线
        var System = window.System;
        if (System && System.stbID) {
            return retail.hnyx;
        }
    } catch (e) {
    }
    try {//广东广电
        if (CA && StorageService && FileSystem) {
            return retail.gdgd;
        }
        //var storageList = StorageService.getStorageInfos();
        //if (storageList && storageList != 'undefined') {
        //    var partitionPathList = storageList[0].getPartitionsInfo()[0];
        //    var partitionPath = partitionPathList.path;
        //    var dir = FileSystem.getDirectory(partitionPath);
        //    var flist = dir.fileList;
        //
        //    for (var i in flist) {
        //        if (flist[i].name.substring(0, 6) == "cacard") {
        //            var cardNo = "96956" + flist[i].name.substring(6, 12);
        //        }
        //    }
        //}
    } catch (e) {
    }
    return retail.none;
}

var retailId = getRetailId();
export {retail,getRetailId,retailId};