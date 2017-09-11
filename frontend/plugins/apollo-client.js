import Vue from 'vue';
import ApolloClient, { createBatchingNetworkInterface } from 'apollo-client';
import VueApollo from 'vue-apollo';

const networkInterface = createBatchingNetworkInterface({
    uri: '/backend/private/graphql',
    //credentials: 'same-origin',
    dataIdFromObject: o => o.Id
});

networkInterface.use([{
  applyBatchMiddleware(req, next) {
    if (!req.options.headers) {
      req.options.headers = {};  // Create the header object if needed.
    }
    req.options.headers['x-access-token'] = sessionStorage.getItem('x-access-token') ? sessionStorage.getItem('x-access-token') : null;
    //console.log(req.options.headers);
    next();
  }
}]);

const apolloClient = new ApolloClient({
    networkInterface
});

Vue.use(VueApollo);

const apolloProvider = new VueApollo({
  defaultClient: apolloClient,
})

export default apolloProvider;
