helpstat = false;
stprompt = true;
basic = false;

function strike() {
        if (helpstat) {
                alert("Bold text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[s]TEXT[/s]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[s]" + twrite + "[/s]";
                }
        }
}
function sub() {
        if (helpstat) {
                alert("Bold text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[sub]TEXT[/sub]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[sub]" + twrite + "[/sub]";
                }
        }
}
function sup() {
        if (helpstat) {
                alert("Bold text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[sup]TEXT[/sup]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[sup]" + twrite + "[/sup]";
                }
        }
}
function bold() {
        if (helpstat) {
                alert("Bold text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[b]TEXT[/b]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[b]" + twrite + "[/b]";
                }
        }
}
function italic() {
        if (helpstat) {
                alert("Italicizes text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[i]TEXT[/i]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[i]" + twrite + "[/i]";
                }
        }
}
function underline(){
        if (helpstat) {
                alert("Underlines text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[u]TEXT[/u]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[u]" + twrite + "[/u]";
                }
        }
}
function center(){
        if (helpstat) {
                alert("Centers text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[center][/center]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[center]" + twrite + "[/center]";
                }
        }
}
function hbar(){
        if (helpstat) {
                alert("Creates a horizontal bar.");
        }
        else {
                document.editor.info.value = document.editor.info.value + "[hr]\n";
        }
}
function lbreak(){
        if (helpstat) {
                alert("Makes a new line, the equivalent of return or enter.");
        }
        else {
                document.editor.info.value = document.editor.info.value + "[br]\n";
        }
}
function right(){
        if (helpstat) {
                alert("Centers text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[right][/right]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[right]" + twrite + "[/right]";
                }
        }
}
function left(){
        if (helpstat) {
                alert("Centers text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[left][/left]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[left]" + twrite + "[/left]";
                }
        }
}
function maillink(){
        if (helpstat) {
                alert("Begins a link.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + '[mail]you@domain.com[/mail]';
        }
        else if (stprompt) {
                twrite = prompt("File location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.info.value = document.editor.info.value + '[mail]' + twrite + '[/mail]';
                for(;;){
                        twrite = prompt("Text?",'');
                        if (twrite != "" && twrite != null){
                                break;
                        }
                        else {
                                prompt("You must enter the link text.",'Ok, sorry.');
                        }
                        }
                document.editor.info.value = document.editor.info.value + twrite + '[/mail]\n';
                        }
        }
}
function linkopen(){
        if (helpstat) {
                alert("Begins a link.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + '[url]http://www.domain.com[/url]';
        }
        else if (stprompt) {
                twrite = prompt("File location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.info.value = document.editor.info.value + '[url]' + twrite + '[/url]';
                for(;;){
                        twrite = prompt("Text?",'');
                        if (twrite != "" && twrite != null){
                                break;
                        }
                        else {
                                prompt("You must enter the link text.",'Ok, sorry.');
                        }
                        }
                document.editor.info.value = document.editor.info.value + twrite + '[/url]\n';
                        }
        }
}
function ul(){
        if (helpstat) {
                alert("Centers text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[ul][li]Text[/li][/ul]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[ul][li]" + twrite + "[/li][/ul]";
                }
        }
}
function ol(){
        if (helpstat) {
                alert("Centers text.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[ol][li]Text[/li][/ol]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[ol][li]" + twrite + "[/li][/ol]";
                }
        }
}
function biggrin(){
        if (helpstat) {
                alert("Enters big grin smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":D";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":D";
        }
}
function smile(){
        if (helpstat) {
                alert("Enters smile smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":)";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":)";
        }
}
function sad(){
        if (helpstat) {
                alert("Enters sad smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":(";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":(";
        }
}
function cool(){
        if (helpstat) {
                alert("Enters cool smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "8)";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + "8)";
        }
}
function mad(){
        if (helpstat) {
                alert("Enters mad smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":@";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":@";
        }
}
function wink(){
        if (helpstat) {
                alert("Enters wink smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ";)";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ";)";
        }
}
function confused(){
        if (helpstat) {
                alert("Enters confused smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "???";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + "???";
        }
}
function amazed(){
        if (helpstat) {
                alert("Enters amazed smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":amazed:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":amazed:";
        }
}
function notrust(){
        if (helpstat) {
                alert("Enters notrust smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":notrust:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":notrust:";
        }
}
function noworry(){
        if (helpstat) {
                alert("Enters noworry smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":noworry:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":noworry:";
        }
}
function nuts(){
        if (helpstat) {
                alert("Enters nuts smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":nuts:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":nuts:";
        }
}
function oh(){
        if (helpstat) {
                alert("Enters oh smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":oh:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":oh:";
        }
}
function rolleyes(){
        if (helpstat) {
                alert("Enters rolleyes smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":rolleyes:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":rolleyes:";
        }
}
function cry(){
        if (helpstat) {
                alert("Enters cry smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":'(";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":'(";
        }
}
function sick(){
        if (helpstat) {
                alert("Enters sick smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":sick:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":sick:";
        }
}
function suspicious(){
        if (helpstat) {
                alert("Enters suspicious smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":suspicious:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":suspicious:";
        }
}
function tongue(){
        if (helpstat) {
                alert("Enters tongue smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":P";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":P";
        }
}
function unsure(){
        if (helpstat) {
                alert("Enters unsure smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":unsure:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":unsure:";
        }
}
function wacko(){
        if (helpstat) {
                alert("Enters wacko smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":wacko:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":wacko:";
        }
}
function weird(){
        if (helpstat) {
                alert("Enters weird smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":weird:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":weird:";
        }
}
function worried(){
        if (helpstat) {
                alert("Enters worried smilie.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + ":worried:";
        }
        else if (stprompt) {
                document.editor.info.value = document.editor.info.value + ":worried:";
        }
}
function table(){
        if (helpstat) {
                alert("Enters a table.");
        }
        else if (basic) {
                document.editor.info.value = document.editor.info.value + "[table][tr][td]TEXT[/td][/tr][/table]";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.info.value = document.editor.info.value + "[table][tr][td]" + twrite + "[/td][/tr][/table]";
                }
        }
}