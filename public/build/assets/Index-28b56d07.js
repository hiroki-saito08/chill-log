import{m as d,o as m,f as g,a as n,u as l,b as e,t as f,w as i,F as L,d as r,l as J,g as k,i as _,p as b,q as E,n as z,e as H,k as P}from"./app-19f02ebd.js";import{T as Q,Z as W,i as M}from"./index.esm-3e725958.js";import{_ as ee}from"./Header-d21c7276.js";import{_ as K}from"./PrimaryButton-df372335.js";import{_ as S,a as V}from"./SecondaryButton-1329a5e0.js";import{E as te}from"./index-410f0929.js";/* empty css            */import"./ApplicationLogo-0f8492d1.js";import"./NavLink-e49decb6.js";const oe={class:"w-2/3 md:w-1/2 m-auto mt-10 mb-20"},le=e("h2",{class:"text-2xl font-bold mb-6"},"記事の投稿",-1),se={class:"mt-10 mb-10"},ne=e("h2",{class:"text-2xl font-bold mb-6"},"ユーザー情報",-1),ae={class:"mt-5"},ie={class:"mt-5"},re={class:"text-center"},de={class:"mb-10"},ue={class:"mb-10"},ce={class:"mb-10"},me={class:"container mx-auto flex"},ge={class:"bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md"},pe=e("h2",{class:"text-lg font-medium text-gray-900 mb-4"},"記事を投稿する",-1),fe={key:0},_e={class:"m-3"},be={class:"relative mb-4"},he=e("label",{for:"title",value:"title",class:"leading-7 text-sm text-gray-600"},"Title",-1),ve={class:"relative mb-4"},xe=e("label",{for:"content",value:"content",class:"leading-7 text-sm text-gray-600"},"Content",-1),ye={class:"mb-5"},we={key:1,class:"mt-2 mb-2"},Ce={class:"mt-6 flex justify-end"},ke={class:"m-5"},Ee={key:0,class:"mt-4 mb-4"},Pe=e("p",null,[e("strong",null,"クリックした位置情報:")],-1),Me={class:"container mx-auto"},Se={class:"bg-white rounded-lg p-8 md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md"},Ve=e("h2",{class:"text-lg font-medium text-gray-900 mb-4"},"名前を変更する",-1),Ie={class:"relative mb-4"},Te=e("label",{for:"name",value:"name",class:"leading-7 text-sm text-gray-600"},"Name",-1),Ue={class:"mt-6"},Be={__name:"Index",props:{user:Array},setup(v){const h=v,{VITE_GMAP_API_KEY:N}={VITE_PUSHER_APP_KEY:"",VITE_PUSHER_HOST:"",VITE_PUSHER_PORT:"443",VITE_PUSHER_SCHEME:"https",VITE_PUSHER_APP_CLUSTER:"mt1",VITE_GMAP_API_KEY:"AIzaSyBMN5q_xRCUrlFZf2jdYvlft75XVP1hYEw",BASE_URL:"/build/",MODE:"production",DEV:!1,PROD:!0,SSR:!1},I=d({lat:35.6895,lng:139.6917}),$=d(10),p=d(null),D=d(null),c=d([]),B=a=>{p.value={lat:a.latLng.lat(),lng:a.latLng.lng()}},Y=()=>{navigator.geolocation?navigator.geolocation.getCurrentPosition(a=>{I.value={lat:a.coords.latitude,lng:a.coords.longitude}}):alert("Geolocation is not supported by this browser.")},x=d(!1),y=d(!1),w=d(!1),t=Q({user_id:h.user.id,status:1,title:null,content:null,image:null,location:{lat:null,lng:null}}),u=d(h.user.name),F=()=>{x.value=!0},O=()=>{y.value=!0},G=()=>{w.value=!0},T=()=>{x.value=!1,t.reset()},U=()=>{y.value=!1},C=()=>{w.value=!1,u.value=""},R=()=>{A()&&P.Inertia.post(route("post.store"),t)},A=()=>(c.value=[],t.title&&t.content&&t.location.lat?!0:(t.title||c.value.push("Titleは必須です"),t.content||c.value.push("Contentは必須です"),t.location.lat||c.value.push("位置の選択は必須です"),!1)),j=()=>{console.log(u),P.Inertia.post(route("profile.update",h.user.id),{_method:"put",name:u.value}),alert("変更しました"),C()},q=a=>{const s=a.target.files[0];t.image=s},Z=()=>{t.location=p.value,U()},X=()=>{A()&&(t.status=0,P.Inertia.post(route("post.save"),t))};return(a,s)=>(m(),g(L,null,[n(l(W),{title:"profile"}),n(ee,{authProps:h,page:"profile"},null,8,["authProps"]),e("div",oe,[e("div",{class:"mb-10"},[le,e("button",{onClick:F,class:"w-full text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg"},"投稿する")]),e("div",se,[ne,e("ul",null,[e("li",ae,"ID: "+f(v.user.id),1),e("li",ie,"名前: "+f(v.user.name),1)])]),e("div",re,[e("button",{onClick:G,class:"w-full text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg mb-10"},"名前を変更する"),e("div",de,[n(l(M),{href:a.route("post.own"),class:"w-full block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg"},{default:i(()=>[r("自分の投稿一覧")]),_:1},8,["href"])]),e("div",ue,[n(l(M),{href:a.route("post.savePosts"),class:"w-full block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg"},{default:i(()=>[r("下書き一覧")]),_:1},8,["href"])]),e("div",ce,[n(l(M),{href:a.route("post.favorite"),class:"w-full block text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg mb-10"},{default:i(()=>[r("お気に入り投稿一覧")]),_:1},8,["href"])])])]),n(S,{show:x.value,onClose:T},{default:i(()=>[e("form",{onSubmit:s[4]||(s[4]=H((...o)=>R&&R(...o),["prevent"]))},[e("div",me,[e("div",ge,[pe,c.value.length?(m(),g("p",fe,[e("ul",_e,[(m(!0),g(L,null,J(c.value,o=>(m(),g("li",{key:o,class:"text-red-500 list-disc mb-3"},f(o),1))),128))])])):k("",!0),e("div",be,[he,_(e("input",{id:"title","onUpdate:modelValue":s[0]||(s[0]=o=>l(t).title=o),type:"text",placeholder:"title",onKeyup:E(o=>!1,["enter"]),name:"title",maxlength:"20",class:"w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"},null,544),[[b,l(t).title]])]),e("div",ve,[xe,_(e("textarea",{id:"content","onUpdate:modelValue":s[1]||(s[1]=o=>l(t).content=o),type:"textarea",placeholder:"content",onKeyup:E(o=>!1,["enter"]),name:"content",maxlength:"250",class:"w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"},null,544),[[b,l(t).content]])]),e("div",ye,[e("input",{id:"image",onChange:q,type:"file",placeholder:"image",name:"image"},null,32)]),e("button",{onClick:O,class:"text-white bg-indigo-500 border-0 py-2 px-6 text-lg w-2/5",type:"button"},"位置を選択する"),l(t).location.lat?(m(),g("div",we,[e("p",null,[r("緯度: "),_(e("input",{id:"location","onUpdate:modelValue":s[2]||(s[2]=o=>l(t).location.lat=o),type:"text",name:"location.lat",class:"border-none"},null,512),[[b,l(t).location.lat]])]),e("p",null,[r("経度: "),_(e("input",{id:"location","onUpdate:modelValue":s[3]||(s[3]=o=>l(t).location.lng=o),type:"text",name:"location.lng",class:"border-none"},null,512),[[b,l(t).location.lng]])])])):k("",!0),e("div",Ce,[n(V,{class:"ml-3",onClick:X},{default:i(()=>[r(" 下書きに保存する ")]),_:1}),n(V,{class:"ml-3",onClick:T},{default:i(()=>[r(" Cancel ")]),_:1}),n(K,{class:z(["ml-3",{"opacity-25":l(t).processing}]),disabled:l(t).processing},{default:i(()=>[r(" 投稿する ")]),_:1},8,["class","disabled"])])])])],32)]),_:1},8,["show","onClose"]),n(S,{show:y.value,onClose:U},{default:i(()=>[n(l(te),{ref_key:"mapRef",ref:D,"api-key":l(N),style:{width:"100%",height:"450px"},center:I.value,zoom:$.value,onClick:B},null,8,["api-key","center","zoom"]),e("div",ke,[e("button",{class:"block mb-5 border-b border-black",onClick:Y},"現在地を取得する"),p.value?(m(),g("div",Ee,[Pe,e("p",null,"緯度: "+f(p.value.lat),1),e("p",null,"経度: "+f(p.value.lng),1)])):k("",!0),e("button",{onClick:Z,class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg"},"ここを選択する")])]),_:1},8,["show","onClose"]),n(S,{show:w.value,onClose:C},{default:i(()=>[e("form",{onSubmit:H(j,["prevent"])},[e("div",Me,[e("div",Se,[Ve,e("div",Ie,[Te,_(e("input",{id:"name","onUpdate:modelValue":s[5]||(s[5]=o=>u.value=o),type:"text",placeholder:"name",onKeyup:E(o=>!1,["enter"]),name:"name",maxlength:"10",class:"w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"},null,544),[[b,u.value]])]),e("div",Ue,[n(V,{onClick:C},{default:i(()=>[r(" Cancel ")]),_:1}),n(K,{class:z(["ml-3",{"opacity-25":u.value.processing}]),disabled:u.value.processing},{default:i(()=>[r(" 変更する ")]),_:1},8,["class","disabled"])])])])],32)]),_:1},8,["show","onClose"])],64))}};export{Be as default};