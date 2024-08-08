import{h as u,o as a,c as f,w as s,a as i,u as e,f as g,g as p,b as o,d as n,n as _,e as h}from"./app-5d32394d.js";import{_ as y}from"./GuestLayout-e4928b73.js";import{_ as v}from"./PrimaryButton-30682dd8.js";import{T as b,Z as x,i as k}from"./index.esm-8f400f0b.js";/* empty css            */import"./ApplicationLogo-808b850a.js";const w=o("div",{class:"mb-4 text-sm text-gray-600"}," Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1),V={key:0,class:"mb-4 font-medium text-sm text-green-600"},B={class:"mt-4 flex items-center justify-between"},$={__name:"VerifyEmail",props:{status:String},setup(r){const c=r,t=b({}),d=()=>{t.post(route("verification.send"))},l=u(()=>c.status==="verification-link-sent");return(m,E)=>(a(),f(y,null,{default:s(()=>[i(e(x),{title:"Email Verification"}),w,l.value?(a(),g("div",V," A new verification link has been sent to the email address you provided during registration. ")):p("",!0),o("form",{onSubmit:h(d,["prevent"])},[o("div",B,[i(v,{class:_({"opacity-25":e(t).processing}),disabled:e(t).processing},{default:s(()=>[n(" Resend Verification Email ")]),_:1},8,["class","disabled"]),i(e(k),{href:m.route("logout"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:s(()=>[n("Log Out")]),_:1},8,["href"])])],32)]),_:1}))}};export{$ as default};