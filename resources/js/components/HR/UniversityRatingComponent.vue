<template>
<div>
<star-rating @rating-selected ="setRating" :read-only="editable" :inline="true" :show-rating="true" :star-size="20" v-model="rating" :increment="0.5" active-color="#CCCC00"></star-rating>
<span v-if="visible" class="ml-2 badge badge-success">Successfully Updated</span>
</div>
</template>

<script>

export default {
    props:['edit','value','university'],
    data () {
      return {
        rating:0.0,
        editable:true,
        visible:false
      }
    },
    mounted () { 
      this.fillData()
    },
    methods:{
        fillData(){
            this.rating=this.value
            this.editable=this.edit
        },
        setRating(){
            this.university.rating=this.rating;
            let url='/hr/universities/'+this.university.id+'/rating'
            axios.put(url,this.university)
            .then((response)=>{
                this.visible=true
                var self=this
                setTimeout(function(){
                    self.visible=false
                },3000);
            })
            .catch(error=>{
                console.log('err',error);
            })
        }
    }

}
</script>

</style>