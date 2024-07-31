import{A as D}from"./ApplicationLogo-b2882568.js";import{A as M,I as B,h as _,m as $,o as u,f as p,b as e,r as f,i as x,J as w,a,w as o,n as c,T as N,c as C,u as b,L,d as i,t as g,g as E}from"./app-6717543a.js";import{_ as j}from"./NavLink-4bee1ae8.js";import{i as z}from"./index.esm-cc450b31.js";const A={class:"relative"},S={__name:"Dropdown",props:{align:{default:"right"},width:{default:"48"},contentClasses:{default:()=>["py-1","bg-white"]}},setup(r){const s=r,t=h=>{n.value&&h.key==="Escape"&&(n.value=!1)};M(()=>document.addEventListener("keydown",t)),B(()=>document.removeEventListener("keydown",t));const l=_(()=>({48:"w-48"})[s.width.toString()]),m=_(()=>s.align==="left"?"origin-top-left left-0":s.align==="right"?"origin-top-right right-0":"origin-top"),n=$(!1);return(h,d)=>(u(),p("div",A,[e("div",{onClick:d[0]||(d[0]=y=>n.value=!n.value)},[f(h.$slots,"trigger")]),x(e("div",{class:"fixed inset-0 z-40",onClick:d[1]||(d[1]=y=>n.value=!1)},null,512),[[w,n.value]]),a(N,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:o(()=>[x(e("div",{class:c(["absolute z-50 mt-2 rounded-md shadow-lg",[l.value,m.value]]),style:{display:"none"},onClick:d[2]||(d[2]=y=>n.value=!1)},[e("div",{class:c(["rounded-md ring-1 ring-black ring-opacity-5",r.contentClasses])},[f(h.$slots,"content")],2)],2),[[w,n.value]])]),_:3})]))}},k={__name:"DropdownLink",setup(r){return(s,t)=>(u(),C(b(L),{class:"block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"},{default:o(()=>[f(s.$slots,"default")]),_:3}))}},v={__name:"ResponsiveNavLink",props:["href","active"],setup(r){const s=r,t=_(()=>s.active?"block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-left text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out");return(l,m)=>(u(),C(b(L),{href:r.href,class:c(t.value)},{default:o(()=>[f(l.$slots,"default")]),_:3},8,["href","class"]))}},V={class:"min-h-screen bg-gray-100"},O={class:"bg-white border-b border-gray-100"},T={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},P={class:"flex justify-between h-16"},I={class:"flex"},J={class:"shrink-0 flex items-center"},R={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},U={class:"hidden sm:flex sm:items-center sm:ml-6"},q={class:"ml-3 relative"},F={class:"inline-flex rounded-md"},G={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"},H=e("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[e("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1),K={class:"-mr-2 flex items-center sm:hidden"},Q={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},W={class:"pt-2 pb-3 space-y-1"},X={class:"pt-4 pb-1 border-t border-gray-200"},Y={class:"px-4"},Z={class:"font-medium text-base text-gray-800"},ee={class:"font-medium text-sm text-gray-500"},te={class:"mt-3 space-y-1"},se={key:0,class:"bg-white shadow"},oe={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"},le={__name:"AuthenticatedLayout",setup(r){const s=$(!1);return(t,l)=>(u(),p("div",null,[e("div",V,[e("nav",O,[e("div",T,[e("div",P,[e("div",I,[e("div",J,[a(b(z),{href:t.route("dashboard")},{default:o(()=>[a(D,{class:"block w-20"})]),_:1},8,["href"])]),e("div",R,[a(j,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:o(()=>[i(" Dashboard ")]),_:1},8,["href","active"])])]),e("div",U,[e("div",q,[a(S,{align:"right",width:"48"},{trigger:o(()=>[e("span",F,[e("button",G,[i(g(t.$page.props.auth.user.name)+" ",1),H])])]),content:o(()=>[a(k,{href:t.route("profile.edit")},{default:o(()=>[i(" Profile ")]),_:1},8,["href"]),a(k,{href:t.route("logout"),method:"post",as:"button"},{default:o(()=>[i(" Log Out ")]),_:1},8,["href"])]),_:1})])]),e("div",K,[e("button",{onClick:l[0]||(l[0]=m=>s.value=!s.value),class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"},[(u(),p("svg",Q,[e("path",{class:c({hidden:s.value,"inline-flex":!s.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:c({hidden:!s.value,"inline-flex":s.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:c([{block:s.value,hidden:!s.value},"sm:hidden"])},[e("div",W,[a(v,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:o(()=>[i(" Dashboard ")]),_:1},8,["href","active"])]),e("div",X,[e("div",Y,[e("div",Z,g(t.$page.props.auth.user.name),1),e("div",ee,g(t.$page.props.auth.user.email),1)]),e("div",te,[a(v,{href:t.route("profile.edit")},{default:o(()=>[i(" Profile ")]),_:1},8,["href"]),a(v,{href:t.route("logout"),method:"post",as:"button"},{default:o(()=>[i(" Log Out ")]),_:1},8,["href"])])])],2)]),t.$slots.header?(u(),p("header",se,[e("div",oe,[f(t.$slots,"header")])])):E("",!0),e("main",null,[f(t.$slots,"default")])])]))}};export{le as _};
