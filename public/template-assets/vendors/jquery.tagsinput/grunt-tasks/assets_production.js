module.exports = function(grunt) {
   grunt.registerTask('template-assets:production',
   [
      'cssmin:plugin',
      'uglify:plugin'
   ]);
};
