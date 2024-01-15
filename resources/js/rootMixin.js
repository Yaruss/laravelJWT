export default {
    computed: {
        islogin() {
            return this.$root.$store.state.login?.login;
        }
    },
    methods: {
        localeDate(d) {
            return (new Date(d * 1000)).toLocaleString();
        },
        anyFind(item, key, val) {
            if (Array.isArray(item)) {
                return item.find((i) => {
                    return i[key] == val;
                });
            }
        },
        isError(i, n, css = 'alert-danger') {
            if (n in (i = 'errors' in i ? i.errors : {}))
                return '<div class="alert ' + css + ' mb-3 mt-1 w-100">' + i[n] + '</div>';
        },
        stdQuery(parent, data) {
            return {
                defData: {
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
                    this.setHead(axios);
                    axios(d)
                        .then((response) => {
                            parent.$root.$store.state.resultjson = response.data;
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
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.access_token;
                    }
                },
            }
        },
    }
}
