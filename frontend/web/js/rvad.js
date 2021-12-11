let $downloadBtn = $('#download-btn')

$downloadBtn.on('click',
  () => $.get('/site/resource-download', { uuid: $downloadBtn.data().uuid }).
    done(() => window.location.href = $downloadBtn.attr('href')))
