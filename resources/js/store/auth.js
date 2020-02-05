export default function auth({ next, router }) {
    //console.log("Token",sessionStorage.getItem('token'))
    if (!sessionStorage.getItem('token')) {
        return router.push('/login');
    }
    return next();
}