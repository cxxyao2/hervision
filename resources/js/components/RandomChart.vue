<template>
  <div class="small">
    <line-chart :chart-data="datacollection"></line-chart>
    <div>
        <input type="radio" id="y2018" name="yearname" value="2018"  checked v-model="yearname"><label for="y2018">2018</label>
        <input type="radio" id="y2019" name="yearname" value="2019" v-model="yearname" ><label for="y2019">2019</label>
        <input type="radio" id="yall" name="yearname" value="all"  v-model="yearname" ><label for="yall">all</label>

        <button @click="getOutput()" class="btn btn-primary">getData</button>
    </div>
  </div>
</template>

<script>
  import LineChart from './LineChart.js'

  export default {
    components: {
      LineChart
    },
    data () {
      return {
        yearname : '2018',
        mydata : null,
        mydata2018: null,
        output2018: [],
        mydata2019: null,
        output2019: [],
        err : null ,
        datacollection: null
      }
    },
    mounted () {
      // this.getOutput()
    },
    methods: {
      fillData () {
        this.datacollection = {
         labels: ['January', 'February', 'March', 'April'],
            datasets: [
                this.mydata2018,
                this.mydata2019
            ]
        }
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      },
      async getOutput () {
      await window.axios.get('/monthoutput/' + this.yearname )
        .then(response => {
            this.mydata = response.data;
        })
        .catch(error => this.err = error.response.data);

        this.output2019 = [];
        this.output2018 = [];
        this.mydata.forEach(red => {
            if(red.yearname =='2018'){
                this.output2018.push(red.salesoutput);
            }

        });

         this.mydata.forEach(red => {
            if(red.yearname =='2019') {
                this.output2019.push(red.salesoutput);
            }

        });

        this.mydata2018 =
        {
                    label: '2018',
                    borderColor: '#FFFF00',
                    pointBackgroundColor: 'white',
                    borderWidth: 1,
                    pointBorderColor: 'white',
                    backgroundColor: this.gradient,
                    data: this.output2018
        };
        this.mydata2019 =
        {
                    label: '2019',
                    borderColor: '#8B008B',
                    pointBackgroundColor: 'white',
                    borderWidth: 1,
                    pointBorderColor: 'white',
                    backgroundColor: this.gradient,
                    data: this.output2019
        };
        this.fillData();

      }
    }
  }
</script>
