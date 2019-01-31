module.exports = {
  pages: {
    index: {
      entry: 'src/main.js', //entry for the public page
      template: 'public/index.html', // source template
      filename: 'index.html' // output as dist/*
    },
    signin: {
      entry: 'src/student/main.js',
      template: 'public/student.html',
      filename: 'student.html'
    }
  },
  devServer: {
    historyApiFallback: {
      rewrites: [
        { from: /\/index/, to: '/index.html' },
        { from: /\/student/, to: '/student.html' }
      ]
    }
  }
}