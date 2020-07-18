class gridStack{
    constructor(element, sizeStack, maxStack){
        this.element = element;
        this.sizeStack = sizeStack;
        this.maxStack = maxStack ? maxStack : null;
        this.calcule()
        $(window).resize( e => {
            this.calcule()
        })
        let observer = new MutationObserver(mutations => {
            mutations.forEach( mutation => {
                let newNodes = mutation.addedNodes;
                if( newNodes !== null ){
                    this.calcule()
                }
            });    
        });
        
        observer.observe(element[0], {childList: true});
    }
    calcule(){
        const w_body = $(document.body).width();
        const residuo = w_body % this.sizeStack
        const n_childs = this.element.children().length
        let w_element = w_body - residuo
        let stack = w_element / this.sizeStack
        
        
        if(this.maxStack) stack = this.maxStack
        if(n_childs <= stack) w_element = n_childs * this.sizeStack
        if (this.element.width() != w_element) this.element.width(w_element)
    }
}