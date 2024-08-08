import{m as h,o as s,f as l,a as m,u as o,b as t,t as c,F as x,l as C,d as v,g as _,n as E,w as b,k as f,i as p,p as y,q as V,v as rt,e as D,s as I}from"./app-19f02ebd.js";import{_ as ct}from"./Header-d21c7276.js";import{T as Y,Z as ut,i as mt}from"./index.esm-3e725958.js";import{_ as G}from"./PrimaryButton-df372335.js";import{_ as z,a as q}from"./SecondaryButton-1329a5e0.js";import{E as Z}from"./index-410f0929.js";/* empty css            */import"./ApplicationLogo-0f8492d1.js";import"./NavLink-e49decb6.js";const _t={class:"mt-10 p-2 md:w-9/12 m-auto"},pt={class:"md:p-10 border mb-5"},gt={class:"text-center text-xl font-bold"},ht={class:"text-right text-lg pt-5 pb-5"},ft={key:0},bt={style:{height:"70vh"}},vt=["src"],xt={key:1},yt={class:"mt-5 mb-5"},kt={class:"pt-5 pb-5 whitespace-pre-wrap text-center"},wt={class:"flex justify-between pt-2 border-t"},Ct={key:0},It={key:1},Pt={class:"flex flex-wrap justify-end"},Et={key:0},Vt={class:"m-5"},Ut={class:"mt-4 mb-4"},Mt=t("p",null,[t("strong",null,"座標:")],-1),St={class:"flex"},Tt={class:"mt-10 w-2/3 m-auto"},Rt=t("h3",{class:"mt-5 mb-10 text-xl font-bold"},"コメント一覧",-1),jt={key:0},zt={class:"border p-5"},Ft={class:"stars relative mb-4"},At=["checked"],Lt=t("label",null,"★",-1),Nt=["checked"],Kt=t("label",null,"★",-1),$t=["checked"],Bt=t("label",null,"★",-1),Ht=["checked"],Ot=t("label",null,"★",-1),Dt=["checked"],Yt=t("label",null,"★",-1),Gt={key:0},qt={class:"h-80 mb-5"},Zt=["src"],Xt={class:"pt-2 pb-4 text-xl font-bold"},Jt={class:"pt-2 pb-2"},Qt={class:"text-right text-lg pt-5 pb-5"},Wt={key:1,class:"flex flex-wrap justify-end"},te={class:"m-10 flex justify-center"},ee={class:"container mx-auto flex"},oe={class:"bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md"},se=t("h2",{class:"text-lg font-medium text-gray-900 mb-4"},"記事を編集する",-1),le={key:0},ne={class:"m-3"},ae={class:"relative mb-4"},ie=t("label",{for:"title",value:"title",class:"leading-7 text-sm text-gray-600"},"Title",-1),de={class:"relative mb-4"},re=t("label",{for:"content",value:"content",class:"leading-7 text-sm text-gray-600"},"content",-1),ce={class:"flex mb-5"},ue=["disabled"],me=t("label",{for:" deleteImage",class:"leading-7 pr-3"},"登録済みの画像を削除",-1),_e=["disabled"],pe={key:1,class:"mt-2 mb-2"},ge={class:"mt-6 flex justify-end"},he={key:0},fe={key:1},be={class:"m-5"},ve={key:0,class:"mt-4 mb-4"},xe=t("p",null,[t("strong",null,"クリックした位置情報:")],-1),ye={class:"container mx-auto flex"},ke={class:"bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md"},we=t("h2",{class:"text-lg font-medium text-gray-900 mb-4"},"コメントを投稿する",-1),Ce={key:0},Ie={class:"m-3"},Pe={class:"stars relative mb-4"},Ee={class:"form-stars"},Ve=t("label",{for:"star01"},"★",-1),Ue=t("label",{for:"star02"},"★",-1),Me=t("label",{for:"star03"},"★",-1),Se=t("label",{for:"star04"},"★",-1),Te=t("label",{for:"star05"},"★",-1),Re={class:"relative mb-4"},je=t("label",{for:"comment_title",value:"comment_title",class:"leading-7 text-sm text-gray-600"},"Title",-1),ze={class:"relative mb-4"},Fe=t("label",{for:"comment_content",value:"comment_content",class:"leading-7 text-sm text-gray-600"},"Content",-1),Ae={class:"mt-6 flex justify-end"},Ge={__name:"Post-detail",props:{post:Object,user:Array,user_id:Number,errors:Object,review:Object,own_post:Boolean,isFavorite:Boolean,favoriteId:Number},setup(r){const a=r,{VITE_GMAP_API_KEY:F}={VITE_PUSHER_APP_KEY:"",VITE_PUSHER_HOST:"",VITE_PUSHER_PORT:"443",VITE_PUSHER_SCHEME:"https",VITE_PUSHER_APP_CLUSTER:"mt1",VITE_GMAP_API_KEY:"AIzaSyBMN5q_xRCUrlFZf2jdYvlft75XVP1hYEw",BASE_URL:"/build/",MODE:"production",DEV:!1,PROD:!0,SSR:!1},k=h(null),A=a.post.location.split(","),U=Number(A[0]),M=Number(A[1]),S=h({lat:U,lng:M}),L=h(16),g=h([]),N=h(!1),T=h(!1),R=h(!1);h(!1);const j=h(!1),i=Y({post_id:a.post.id,user_id:a.user_id,star:null,comment_title:null,comment_content:null,image:null}),d=Y({user_id:a.user_id,status:a.post.status,title:a.post.title,content:a.post.content,image:a.post.image,deleteImage:!1,location:{lat:U,lng:M}}),K=()=>{a.user===null?f.Inertia.get(route("login")):(a.review!=null&&(i.star=a.review.star,i.comment_title=a.review.comment_title,i.comment_content=a.review.comment_content,N.value=!0),nt())},X=u=>{k.value={lat:u.latLng.lat(),lng:u.latLng.lng()}},J=()=>{navigator.geolocation?navigator.geolocation.getCurrentPosition(u=>{S.value={lat:u.coords.latitude,lng:u.coords.longitude}}):alert("Geolocation is not supported by this browser.")},Q=()=>{d.location=k.value,B()},W=()=>{a.user===null?f.Inertia.get(route("login")):a.isFavorite?f.Inertia.delete(route("favorite.destroy",a.favoriteId)):f.Inertia.post(route("favorite.store",{post_id:a.post.id,user_id:a.user_id}))},tt=()=>{confirm("コメントを削除してよろしいですか？")&&(f.Inertia.delete(route("review.destroy",a.review.id)),alert("コメントを削除しました")),w()},et=()=>{N.value?H()&&(f.Inertia.post(route("review.update",a.review.id),{_method:"put",form:i}),alert("コメントを更新しました"),P()):H()&&(f.Inertia.post(route("review.store"),i),alert("コメントを投稿しました"),P())},ot=()=>{dt()&&(d.status=1,f.Inertia.post(route("post.update",a.post.id),{_method:"put",form:d}),alert("投稿を更新しました"),w())},st=()=>{confirm("投稿を削除してよろしいですか？")&&(f.Inertia.delete(route("post.destroy",a.post.id)),alert("投稿を削除しました")),w()},lt=u=>{const n=u.target.files[0];i.image=n},$=u=>{const n=u.target.files[0];d.image=n},nt=()=>{T.value=!0},P=()=>{T.value=!1,i.reset()},at=()=>{j.value=!0},B=()=>{j.value=!1},it=()=>{R.value=!0},w=()=>{R.value=!1,d.reset()},dt=()=>(g.value=[],d.title&&d.content&&d.location.lat?!0:(d.title||g.value.push("Titleは必須です"),d.content||g.value.push("Contentは必須です"),d.location.lat||g.value.push("位置の選択は必須です"),!1)),H=()=>(g.value=[],i.comment_title&&i.comment_content?!0:(i.comment_title||g.value.push("Titleは必須です"),i.comment_content||g.value.push("Contentは必須です"),!1));return(u,n)=>(s(),l(x,null,[m(o(ut),{title:"Post-detail"}),m(ct,{authProps:a,page:"post-detail"},null,8,["authProps"]),t("div",_t,[t("article",pt,[t("h2",gt,"「"+c(r.post.title)+"」",1),t("h3",ht,c(r.post.user.name)+" さんの投稿",1),r.post.images.length?(s(),l("div",ft,[(s(!0),l(x,null,C(r.post.images,e=>(s(),l("div",{key:e.id},[t("div",bt,[t("img",{src:e.path,alt:"画像",class:"w-full h-full object-cover"},null,8,vt)])]))),128))])):(s(),l("div",xt," 画像なし ")),t("div",yt,[t("p",kt,c(r.post.content),1)]),t("div",wt,[t("div",null,"コメント: "+c(r.post.reviews_count)+"件",1),t("div",null,[v(" 評価: "),r.post.rating[0]?(s(),l("span",Ct,c(r.post.rating[0].avg_review),1)):(s(),l("span",It," 0.00 "))])]),t("div",Pt,[r.own_post?(s(),l("button",{key:0,onClick:it,class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 block"},"編集")):_("",!0),r.own_post?(s(),l("button",{key:1,onClick:st,class:"text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 block"},"削除")):_("",!0)])]),r.post.location?(s(),l("div",Et,[m(o(Z),{"api-key":o(F),style:{width:"100%",height:"450px"},center:S.value,zoom:L.value},null,8,["api-key","center","zoom"]),t("div",Vt,[t("div",Ut,[Mt,t("p",null,"緯度: "+c(o(U)),1),t("p",null,"経度: "+c(o(M)),1)])])])):_("",!0),t("div",St,[r.own_post?_("",!0):(s(),l("button",{key:0,onClick:K,class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg ml-auto block"},"コメントする")),r.own_post?_("",!0):(s(),l("button",{key:1,onClick:W},[t("a",{class:E(["unfavorite-star",{"favorite-star":a.isFavorite}])},"★",2)]))])]),t("div",Tt,[Rt,t("article",null,[r.post.reviews?(s(),l("div",jt,[(s(!0),l(x,null,C(r.post.reviews,e=>(s(),l("div",{key:e.id},[t("article",zt,[t("div",Ft,[t("span",null,[t("input",{class:"star5",type:"radio",checked:e.star==5},null,8,At),Lt,t("input",{class:"star4",type:"radio",checked:e.star==4},null,8,Nt),Kt,t("input",{class:"star3",type:"radio",checked:e.star==3},null,8,$t),Bt,t("input",{class:"star2",type:"radio",checked:e.star==2},null,8,Ht),Ot,t("input",{class:"star1",type:"radio",checked:e.star==1},null,8,Dt),Yt])]),e.images?(s(),l("div",Gt,[(s(!0),l(x,null,C(e.images,O=>(s(),l("div",{key:O.id},[t("div",qt,[t("img",{src:O.path,alt:"画像",class:"w-full h-full object-cover"},null,8,Zt)])]))),128))])):_("",!0),t("p",Xt,c(e.comment_title),1),t("p",Jt,c(e.comment_content),1),t("h3",Qt,c(e.user.name)+" さんの投稿",1),a.review.user_id==a.user_id?(s(),l("div",Wt,[t("button",{onClick:K,class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 block"},"編集"),t("button",{onClick:tt,class:"text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg m-5 block"},"削除")])):_("",!0)])]))),128))])):_("",!0)])]),t("div",te,[m(o(mt),{class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg",href:u.route("posts")},{default:b(()=>[v("投稿一覧へ")]),_:1},8,["href"])]),m(z,{show:R.value,onClose:w},{default:b(()=>[t("form",{onSubmit:D(ot,["prevent"])},[t("div",ee,[t("div",oe,[se,g.value.length?(s(),l("p",le,[t("ul",ne,[(s(!0),l(x,null,C(g.value,e=>(s(),l("li",{key:e,class:"text-red-500 list-disc mb-3"},c(e),1))),128))])])):_("",!0),t("div",ae,[ie,p(t("input",{id:"title","onUpdate:modelValue":n[0]||(n[0]=e=>o(d).title=e),type:"text",placeholder:"title",onKeyup:V(e=>!1,["enter"]),name:"title",maxlength:"20",class:"w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"},null,544),[[y,o(d).title]])]),t("div",de,[re,p(t("textarea",{id:"content","onUpdate:modelValue":n[1]||(n[1]=e=>o(d).content=e),type:"textarea",placeholder:"content",onKeyup:V(e=>!1,["enter"]),name:"content",maxlength:"250",class:"w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"},null,544),[[y,o(d).content]])]),t("div",ce,[t("div",null,[t("input",{id:"image",onChange:$,type:"file",placeholder:"image",name:"image",disabled:o(d).deleteImage},null,40,ue)]),t("div",null,[me,p(t("input",{id:"deleteImage","onUpdate:modelValue":n[2]||(n[2]=e=>o(d).deleteImage=e),onChange:$,type:"checkbox",name:"deleteImage",disabled:o(d).image,class:E({"opacity-25":o(d).image})},null,42,_e),[[rt,o(d).deleteImage]])])]),t("button",{onClick:at,class:"text-white bg-indigo-500 border-0 py-2 px-6 text-lg w-2/5",type:"button"},"位置を選択する"),o(d).location.lat?(s(),l("div",pe,[t("p",null,[v("緯度: "),p(t("input",{id:"location","onUpdate:modelValue":n[3]||(n[3]=e=>o(d).location.lat=e),type:"text",name:"location.lat",class:"border-none"},null,512),[[y,o(d).location.lat]])]),t("p",null,[v("経度: "),p(t("input",{id:"location","onUpdate:modelValue":n[4]||(n[4]=e=>o(d).location.lng=e),type:"text",name:"location.lng",class:"border-none"},null,512),[[y,o(d).location.lng]])])])):_("",!0),t("div",ge,[m(q,{onClick:w},{default:b(()=>[v(" Cancel ")]),_:1}),m(G,{class:E(["ml-3",{"opacity-25":o(d).processing}]),disabled:o(d).processing},{default:b(()=>[a.post.status?(s(),l("span",he,"更新する")):(s(),l("span",fe,"投稿する"))]),_:1},8,["class","disabled"])])])])],32)]),_:1},8,["show"]),m(z,{show:j.value,onClose:B},{default:b(()=>[m(o(Z),{ref:"mapRef","api-key":o(F),style:{width:"100%",height:"450px"},center:S.value,zoom:L.value,onClick:X},null,8,["api-key","center","zoom"]),t("div",be,[t("button",{class:"block mb-5 border-b border-black",onClick:J},"現在地を取得する"),k.value?(s(),l("div",ve,[xe,t("p",null,"緯度: "+c(k.value.lat),1),t("p",null,"経度: "+c(k.value.lng),1)])):_("",!0),t("button",{onClick:Q,class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg"},"ここを選択する")])]),_:1},8,["show"]),m(z,{show:T.value,onClose:P},{default:b(()=>[t("form",{onSubmit:D(et,["prevent"])},[t("div",ye,[t("div",ke,[we,g.value.length?(s(),l("p",Ce,[t("ul",Ie,[(s(!0),l(x,null,C(g.value,e=>(s(),l("li",{key:e,class:"text-red-500 list-disc mb-3"},c(e),1))),128))])])):_("",!0),t("div",Pe,[t("span",Ee,[p(t("input",{id:"star01",type:"radio",name:"star",value:"5","onUpdate:modelValue":n[5]||(n[5]=e=>o(i).star=e)},null,512),[[I,o(i).star]]),Ve,p(t("input",{id:"star02",type:"radio",name:"star",value:"4","onUpdate:modelValue":n[6]||(n[6]=e=>o(i).star=e)},null,512),[[I,o(i).star]]),Ue,p(t("input",{id:"star03",type:"radio",name:"star",value:"3","onUpdate:modelValue":n[7]||(n[7]=e=>o(i).star=e)},null,512),[[I,o(i).star]]),Me,p(t("input",{id:"star04",type:"radio",name:"star",value:"2","onUpdate:modelValue":n[8]||(n[8]=e=>o(i).star=e)},null,512),[[I,o(i).star]]),Se,p(t("input",{id:"star05",type:"radio",name:"star",value:"1","onUpdate:modelValue":n[9]||(n[9]=e=>o(i).star=e)},null,512),[[I,o(i).star]]),Te])]),t("div",Re,[je,p(t("input",{id:"comment_title","onUpdate:modelValue":n[10]||(n[10]=e=>o(i).comment_title=e),type:"text",placeholder:"title",onKeyup:V(e=>!1,["enter"]),name:"comment_title",maxlength:"20",class:"w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"},null,544),[[y,o(i).comment_title]])]),t("div",ze,[Fe,p(t("textarea",{id:"comment_content","onUpdate:modelValue":n[11]||(n[11]=e=>o(i).comment_content=e),type:"textarea",placeholder:"content",onKeyup:V(e=>!1,["enter"]),name:"comment_content",maxlength:"250",class:"w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"},null,544),[[y,o(i).comment_content]])]),t("input",{id:"image",onChange:lt,type:"file",placeholder:"image",name:"image"},null,32),t("div",Ae,[m(q,{onClick:P},{default:b(()=>[v(" Cancel ")]),_:1}),m(G,{class:E(["ml-3",{"opacity-25":o(i).processing}]),disabled:o(i).processing},{default:b(()=>[v(" 投稿する ")]),_:1},8,["class","disabled"])])])])],32)]),_:1},8,["show"])],64))}};export{Ge as default};
