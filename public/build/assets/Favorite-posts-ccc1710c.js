import{Z as p,i as _}from"./index.esm-28f94561.js";import{_ as g}from"./Header-f8bf9dd7.js";import{_ as v}from"./Search-28e4684f.js";import{_ as b}from"./Pagination-13988524.js";import{o as t,f as e,a as i,u as l,b as s,F as a,l as u,g as k,w as h,t as n,d as m}from"./app-c12fad1a.js";import"./ApplicationLogo-d8cb323c.js";import"./NavLink-05d9f05b.js";/* empty css            */const y={class:"m-5"},x={class:"grid grid-cols-3"},w={class:"p-5 border"},j={class:"pb-2 border-b"},N={class:"text-lg pt-2 pb-2 font-bold"},P={class:"h-80 pt-3 pb-3"},V={key:0,class:"h-full"},B=["src"],F={key:1},$={class:"flex justify-between pt-2 border-t"},C={key:0},O={key:1},T={class:"m-5 mt-10 mb-10 flex justify-center"},H={__name:"Favorite-posts",props:{posts:Object,user:Array},setup(r){const c=r;return console.log(c.posts),(f,A)=>(t(),e(a,null,[i(l(p),{title:"Posts"}),i(g,{authProps:c},null,8,["authProps"]),s("div",y,[i(v)]),r.posts?(t(),e(a,{key:0},[s("div",x,[(t(!0),e(a,null,u(r.posts.data,o=>(t(),e("div",{key:o.id,class:"m-5"},[i(l(_),{href:f.route("post.show",o.id)},{default:h(()=>[s("article",w,[s("div",j,[s("h2",N,"「"+n(o.title)+"」",1)]),s("div",P,[o.images.length?(t(),e("div",V,[(t(!0),e(a,null,u(o.images,d=>(t(),e("div",{key:d.id,class:"h-full"},[s("img",{src:d.path,alt:"画像",class:"w-full h-full object-cover"},null,8,B)]))),128))])):(t(),e("div",F," 画像なし "))]),s("div",$,[s("div",null,"コメント: "+n(o.reviews_count)+"件",1),s("div",null,[m(" 評価: "),o.rating[0]?(t(),e("span",C,n(o.rating[0].avg_review),1)):(t(),e("span",O," 0.00 "))])])])]),_:2},1032,["href"])]))),128))]),i(b,{class:"mt-6",links:r.posts.links},null,8,["links"])],64)):k("",!0),s("div",T,[i(l(_),{class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg",href:"/"},{default:h(()=>[m("TOPに戻る")]),_:1})])],64))}};export{H as default};
