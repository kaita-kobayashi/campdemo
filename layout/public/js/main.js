/**
 * 画面呼び出し時にイベント挿入&子供がチェック済みなら親もチェック
 * 親ID名称=子供クラス名称
*/
function handlePrivileges(privileges) {
    for (const top in privileges) {
        document.getElementById(top).addEventListener('click', {name: top, handleEvent: checkAllPrivileges})
        const el = document.getElementsByClassName(top);
        for (let i=0; i<el.length; i++) {
            el[i].addEventListener('click', {name: top, handleEvent: checkLookPrivileges})
        }
        let obj = {name: top, handleEvent: checkLookPrivileges};
        obj.handleEvent();
    }
}
// 全選択
function checkAllPrivileges(e){
    const all = document.getElementById(this.name);
    const element = document.getElementsByClassName(this.name);
    for (let i=0; i < element.length; i++) {
        element[i].checked = all.checked;
    }
}
// 連動
function checkLookPrivileges(e) {
    let cnt = 0;
    const all = document.getElementById(this.name);
    const element = document.getElementsByClassName(this.name);
    for (let i = 0; i < element.length; i++) {
        if (element[i].checked) {
            cnt += 1;
        }
    }
    if (element.length === cnt) {
        all.checked = true;
    } else {
        all.checked = false;
    }
}