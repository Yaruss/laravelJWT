
export default {
    computed: {
        islogin(){
            return this.$root.$store.state.login?.login;
        }
    },
    methods: {
        localeDate(d){
            return (new Date(d*1000)).toLocaleString();
        },
        anyFind(item, key, val){
            if(Array.isArray(item)) {
                return item.find((i)=> {
                    return i[key]==val;
                });
            }
        },
        stdQuery(parent, data){
            return {
                defData:{
                    method: 'get',
                    Ok: 'item',
                    Er: 'error',
                    fnOk: (t, v) => {
                        return v;
                    },
                    fnEr: (t, v) => {
                        return v;
                    },
                },
                parent: parent,
                data: data,
                get: function (prop = {}) {
                    let d = this.copyObj(prop);
                    this.setHead(d);
                    console.log(d);
                    axios(d)
                        .then((response) => {
                            parent[d.Ok] = d.fnOk(parent, response.data);
                            parent[d.Er] = {};
                        })
                        .catch((error) => {
                            let er = error.response.data;
                            parent[d.Er] = d.fnEr(parent, er);
                        });
                },
                copyObj: function (prop) {
                    return Object.assign({}, this.defData, this.data, prop);
                },
                setHead: function (d) {
                    let token = this.parent.$root.$store.state.token;
                    if ('access_token' in token) {
                        d['headers'] = 'Authorization: Bearer ' + token.access_token
                    }
                }
            }
        },
    }
}
