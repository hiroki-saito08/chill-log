import{Z as p,i as _}from"./index.esm-cc450b31.js";import{_ as g}from"./Header-e6b2df87.js";import{_ as v}from"./Search-b33ec7e4.js";import{_ as b}from"./Pagination-b6c17e7c.js";import{o as t,f as e,a as i,u as r,b as s,F as l,l as u,g as k,w as h,t as n,d as m}from"./app-6717543a.js";import"./ApplicationLogo-b2882568.js";import"./NavLink-4bee1ae8.js";const y={class:"m-5"},x={class:"grid grid-cols-3"},w={class:"p-5 border"},j={class:"pb-2 border-b"},N={class:"text-lg pt-2 pb-2 font-bold"},P={class:"h-80 pt-3 pb-3"},V={key:0,class:"h-full"},B=["src"],$={key:1},C={class:"flex justify-between pt-2 border-t"},F={key:0},O={key:1},S={class:"m-5 mt-10 mb-10 flex justify-center"},G={__name:"Save-posts",props:{posts:Object,user:Array},setup(a){const c=a;return console.log(c.posts),(f,T)=>(t(),e(l,null,[i(r(p),{title:"Posts"}),i(g,{authProps:c},null,8,["authProps"]),s("div",y,[i(v)]),a.posts?(t(),e(l,{key:0},[s("div",x,[(t(!0),e(l,null,u(a.posts.data,o=>(t(),e("div",{key:o.id,class:"m-5"},[i(r(_),{href:f.route("post.show",o.id)},{default:h(()=>[s("article",w,[s("div",j,[s("h2",N,"「"+n(o.title)+"」",1)]),s("div",P,[o.images.length?(t(),e("div",V,[(t(!0),e(l,null,u(o.images,d=>(t(),e("div",{key:d.id,class:"h-full"},[s("img",{src:d.path,alt:"画像",class:"w-full h-full object-cover"},null,8,B)]))),128))])):(t(),e("div",$," 画像なし "))]),s("div",C,[s("div",null,"コメント: "+n(o.reviews_count)+"件",1),s("div",null,[m(" 評価: "),o.rating[0]?(t(),e("span",F,n(o.rating[0].avg_review),1)):(t(),e("span",O," 0.00 "))])])])]),_:2},1032,["href"])]))),128))]),i(b,{class:"mt-6",links:a.posts.links},null,8,["links"])],64)):k("",!0),s("div",S,[i(r(_),{class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg",href:"/"},{default:h(()=>[m("TOPに戻る")]),_:1})])],64))}};export{G as default};
