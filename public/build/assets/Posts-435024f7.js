import{Z as p,i as _}from"./index.esm-246c28ca.js";import{_ as g}from"./Header-a44c9231.js";import{_ as v}from"./Search-9f6150b7.js";import{_ as b}from"./Pagination-438049ac.js";import{o as t,f as e,a as i,u as r,b as s,F as a,l as u,g as k,w as m,t as n,d as h}from"./app-f05c20dd.js";import"./ApplicationLogo-52b17636.js";import"./NavLink-904d2905.js";/* empty css            */const y={class:"m-5"},x={class:"md:grid grid-cols-3"},w={class:"p-5 border"},P={class:"pb-2 border-b"},j={class:"text-lg pt-2 pb-2 font-bold"},N={class:"h-80 pt-3 pb-3"},V={key:0,class:"h-full"},B=["src"],$={key:1},C={class:"flex justify-between pt-2 border-t"},F={key:0},O={key:1},T={class:"m-5 mt-10 mb-10 flex justify-center"},H={__name:"Posts",props:{posts:Object},setup(l){const c=l;return console.log(c.posts),(f,D)=>(t(),e(a,null,[i(r(p),{title:"Posts"}),i(g,{authProps:c},null,8,["authProps"]),s("div",y,[i(v)]),l.posts?(t(),e(a,{key:0},[s("div",x,[(t(!0),e(a,null,u(l.posts.data,o=>(t(),e("div",{key:o.id,class:"m-5"},[i(r(_),{href:f.route("post.show",o.id)},{default:m(()=>[s("article",w,[s("div",P,[s("h2",j,"「"+n(o.title)+"」",1)]),s("div",N,[o.images.length?(t(),e("div",V,[(t(!0),e(a,null,u(o.images,d=>(t(),e("div",{key:d.id,class:"h-full"},[s("img",{src:d.path,alt:"画像",class:"w-full h-full object-cover"},null,8,B)]))),128))])):(t(),e("div",$," 画像なし "))]),s("div",C,[s("div",null,"コメント: "+n(o.reviews_count)+"件",1),s("div",null,[h(" 評価: "),o.rating[0]?(t(),e("span",F,n(o.rating[0].avg_review),1)):(t(),e("span",O," 0.00 "))])])])]),_:2},1032,["href"])]))),128))]),i(b,{class:"mt-6",links:l.posts.links},null,8,["links"])],64)):k("",!0),s("div",T,[i(r(_),{class:"text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg",href:"/"},{default:m(()=>[h("TOPに戻る")]),_:1})])],64))}};export{H as default};
