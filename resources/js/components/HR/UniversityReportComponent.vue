<template>
  <div class="small">
    <pie-chart :chart-data="datacollection" :options="options"></pie-chart>
  </div>
</template>

<script>
  import PieChart from './LineChart.js'

  export default {
    props: ['applications'],
    components: {
      PieChart
    },
    data () {
      return {
        datacollection: {},
        options:null
      }
    },
    mounted () { 
    console.log(this.applications)
      this.fillData()
    },
    methods: {
      fillData () {
        this.datacollection = {
          labels: ["Kec", "THDC", "Birla", "CU",],
          datasets: [{
              borderWidth: 1,
              borderColor: [
              '#0275d8',
              '#5cb85c',
              '#5bc0de',
              '#f0ad4e'            
              ],
              backgroundColor: [
              '#0275d8',
              '#5cb85c',
              '#5bc0de',
              '#f0ad4e',                
              ],
              data: [1000,	500,	1500,	1000]
            }]
        }
        this.options={
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    }
  }
</script>

<style>
  .small {
    max-width: 300px;
  }
</style>