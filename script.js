(function(){
var ENDPOINT='send.php',TG='TELEGRAM_USERNAME';
document.querySelectorAll('form.lead').forEach(function(f){
f.addEventListener('submit',function(e){
e.preventDefault();
if(f.website.value)return;
var d={},b=f.querySelector('button'),ok=f.querySelector('.ok');
new FormData(f).forEach(function(v,k){d[k]=v});
b.disabled=true;
function done(){f.reset();b.disabled=false;ok.hidden=false}
fetch(ENDPOINT,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(d)})
.then(function(r){if(!r.ok)throw 0;done()})
.catch(function(){
var t=Object.keys(d).filter(function(k){return k!=='website'&&d[k]}).map(function(k){return k+': '+d[k]}).join('\n');
window.open('https://t.me/'+TG+'?text='+encodeURIComponent(t),'_blank');done()});
})})})();
