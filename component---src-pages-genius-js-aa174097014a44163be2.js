(self.webpackChunksite=self.webpackChunksite||[]).push([[519],{3386:function(e,t,n){"use strict";function a(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}n.r(t),n.d(t,{default:function(){return l}});var s=n(3552),i=n(7294),l=function(e){function t(t){var n;return(n=e.call(this,t)||this).model={},n.state={model_available:!1,question:"Where did Tesla born?",passage:"Born and raised in the Austrian Empire, Tesla studied engineering and physics in the 1870s without receiving a\n      degree, and gained practical experience in the early 1880s working in telephony and at Continental Edison in the\n      new electric power industry. He emigrated in 1884 to the United States, where he would become a naturalized\n      citizen. He worked for a short time at the Edison Machine Works in New York City before he struck out on his own.\n      With the help of partners to finance and market his ideas, Tesla set up laboratories and companies in New York to\n      develop a range of electrical and mechanical devices. His alternating current (AC) induction motor and related\n      polyphase AC patents, licensed by Westinghouse Electric in 1888, earned him a considerable amount of money and\n      became the cornerstone of the polyphase system which that company would eventually market.",responses:[]},window.qna.load().then((function(e){n.model=e,n.setState({model_available:!0})})),n.handleChange=n.handleChange.bind(a(n)),n.handleSubmit=n.handleSubmit.bind(a(n)),n}(0,s.Z)(t,e);var n=t.prototype;return n.handleChange=function(e){var t,n=e.target,a="checkbox"===n.type?n.checked:n.value,s=n.name;this.setState(((t={})[s]=a,t))},n.handleSubmit=function(e){var t=this;e.preventDefault(),this.model.findAnswers(this.state.question,this.state.passage).then((function(e){t.setState({responses:JSON.stringify(e)})}))},n.render=function(){return i.createElement("div",{className:"container"},i.createElement("form",null,i.createElement("div",{className:"row"},i.createElement("label",{htmlFor:"passage"},"Context"),i.createElement("textarea",{className:"u-full-width height-10",value:this.state.passage,onChange:this.handleChange,name:"passage"})),i.createElement("div",{className:"row"},i.createElement("div",{className:"six columns"},i.createElement("label",{htmlFor:"question"},"Your question"),i.createElement("input",{className:"u-full-width",type:"text",value:this.state.question,onChange:this.handleChange,name:"question"})),i.createElement("div",{className:"six columns"})),i.createElement("input",{disabled:!this.state.model_available,className:"button-primary",type:"submit",value:"Ask model",onClick:this.handleSubmit})),i.createElement("div",{className:"row"},i.createElement("label",{htmlFor:"responses"},"Context"),i.createElement("textarea",{className:"u-full-width height-5",defaultValue:this.state.responses,name:"responses"})))},t}(i.Component)}}]);
//# sourceMappingURL=component---src-pages-genius-js-aa174097014a44163be2.js.map