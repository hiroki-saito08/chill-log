import{A as c}from"./ApplicationLogo-808b850a.js";import{o as l,f,b as n,a as r,w as o,d as t,u as s,c as i}from"./app-5d32394d.js";import{_ as u}from"./NavLink-975c64f9.js";import{i as a}from"./index.esm-8f400f0b.js";const d={class:"text-lg font-bold body-font header_text"},h={class:"container mx-auto flex flex-wrap flex-col md:flex-row items-center"},m={class:"md:ml-auto flex flex-wrap items-center text-base justify-center"},p={key:1},w={__name:"Header",props:{authProps:Array},setup(_){return(e,v)=>(l(),f("header",d,[n("div",h,[r(u,{href:"/",active:e.route().current("/")},{default:o(()=>[r(c,{class:"block w-20"})]),_:1},8,["active"]),n("nav",m,[r(s(a),{href:e.route("posts"),class:"mr-5 hover:underline"},{default:o(()=>[t("投稿一覧")]),_:1},8,["href"]),r(s(a),{href:e.route("profile"),class:"mr-5 hover:underline"},{default:o(()=>[t("マイページ")]),_:1},8,["href"]),e.$page.props.auth.user?(l(),i(s(a),{key:0,href:e.route("logout"),method:"post",as:"button",class:"mr-5 hover:underline"},{default:o(()=>[t("ログアウト ")]),_:1},8,["href"])):(l(),f("div",p,[r(s(a),{href:e.route("login"),class:"mr-5 hover:underline"},{default:o(()=>[t("ログイン")]),_:1},8,["href"]),r(s(a),{href:e.route("register"),class:"mr-5 hover:underline"},{default:o(()=>[t("新規登録")]),_:1},8,["href"])]))])])]))}};export{w as _};