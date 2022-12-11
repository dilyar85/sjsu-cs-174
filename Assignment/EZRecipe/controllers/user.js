// module.exports.get = function(req, res, next) {
//   res.render('login');
// }
module.exports.index = function (req, res, next) {
  const email = req.param('email')
  res.render('user/index', { name: 'test1' });
}